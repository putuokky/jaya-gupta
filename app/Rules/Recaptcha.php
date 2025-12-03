<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;

class Recaptcha implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $recaptchaSecret = config('services.recaptcha.secret_key');
        
        if (!$recaptchaSecret) {
            $fail($attribute, __('reCAPTCHA is not configured.'));
            return;
        }

        if (empty($value)) {
            $fail($attribute, __('Please verify that you are not a robot.'));
            return;
        }

        try {
            $response = Http::post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => $recaptchaSecret,
                'response' => $value,
            ]);

            $body = $response->json();

            if (!$response->successful() || !isset($body['success'])) {
                $fail($attribute, __('reCAPTCHA verification failed.'));
                return;
            }

            if (!$body['success']) {
                $fail($attribute, __('reCAPTCHA verification failed. Please try again.'));
                return;
            }
        } catch (\Exception $e) {
            $fail($attribute, __('reCAPTCHA verification error. Please try again later.'));
        }
    }
}
