<?php

namespace App\Providers;

use App\Actions\Fortify\AttemptToLogin;
use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Rules\Recaptcha;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureActions();
        $this->configureViews();
        $this->configureRateLimiting();
        $this->configureValidators();
    }

    /**
     * Configure Fortify actions.
     */
    private function configureActions(): void
    {
        Fortify::authenticateUsing(function (Request $request) {
            // Validate login request (includes reCAPTCHA)
            $validated = validator($request->only(['email', 'password', 'g-recaptcha-response']), [
                'email' => ['required', 'email'],
                'password' => ['required', 'string', 'min:6'],
                'g-recaptcha-response' => ['required', 'recaptcha'],
            ], [
                'g-recaptcha-response.required' => __('Please verify that you are not a robot.'),
                'g-recaptcha-response.recaptcha' => __('reCAPTCHA verification failed. Please try again.'),
            ])->validate();

            // Attempt authentication
            if (Auth::attempt($request->only(['email', 'password']), $request->boolean('remember'))) {
                return Auth::user();
            }

            throw ValidationException::withMessages([
                'email' => __('These credentials do not match our records.'),
            ]);
        });
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::createUsersUsing(CreateNewUser::class);
    }

    /**
     * Configure Fortify views.
     */
    private function configureViews(): void
    {
        Fortify::loginView(fn () => view('livewire.auth.login'));
        Fortify::verifyEmailView(fn () => view('livewire.auth.verify-email'));
        Fortify::twoFactorChallengeView(fn () => view('livewire.auth.two-factor-challenge'));
        Fortify::confirmPasswordView(fn () => view('livewire.auth.confirm-password'));
        Fortify::registerView(fn () => view('livewire.auth.register'));
        Fortify::resetPasswordView(fn () => view('livewire.auth.reset-password'));
        Fortify::requestPasswordResetLinkView(fn () => view('livewire.auth.forgot-password'));
    }

    /**
     * Configure rate limiting.
     */
    private function configureRateLimiting(): void
    {
        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });
    }

    /**
     * Configure custom validators.
     */
    private function configureValidators(): void
    {
        Validator::extend('recaptcha', function ($attribute, $value, $parameters, $validator) {
            $rule = new Recaptcha();
            try {
                $rule->validate($attribute, $value, function ($attr, $msg) use ($validator) {
                    $validator->errors()->add($attr, $msg);
                });
                return !$validator->errors()->has($attribute);
            } catch (\Exception $e) {
                return false;
            }
        });
    }
}
