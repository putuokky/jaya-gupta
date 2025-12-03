<x-layouts.auth>
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('Log in to your account')" :description="__('Enter your email and password below to log in')" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-6" id="login-form">
            @csrf

            <!-- Email Address -->
            <flux:input
                name="email"
                :label="__('Email address')"
                :value="old('email')"
                type="email"
                required
                autofocus
                autocomplete="email"
                placeholder="email@example.com"
            />

            <!-- Password -->
            <div class="relative">
                <flux:input
                    name="password"
                    :label="__('Password')"
                    type="password"
                    required
                    autocomplete="current-password"
                    :placeholder="__('Password')"
                    viewable
                />

                @if (Route::has('password.request'))
                    <flux:link class="absolute top-0 text-sm end-0" :href="route('password.request')" wire:navigate>
                        {{ __('Forgot your password?') }}
                    </flux:link>
                @endif
            </div>

            <!-- Remember Me -->
            <flux:checkbox name="remember" :label="__('Remember me')" :checked="old('remember')" />

            <!-- reCAPTCHA v2 Checkbox -->
            <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}" data-callback="onRecaptchaSuccess" data-expired-callback="onRecaptchaExpired"></div>
            
            @error('g-recaptcha-response')
                <div class="text-sm text-red-600">
                    {{ $message }}
                </div>
            @enderror

            <div class="flex items-center justify-end">
                <flux:button variant="primary" type="submit" class="w-full" data-test="login-button">
                    {{ __('Log in') }}
                </flux:button>
            </div>
        </form>

        @if (Route::has('register'))
            <div class="space-x-1 text-sm text-center rtl:space-x-reverse text-zinc-600 dark:text-zinc-400">
                <span>{{ __('Don\'t have an account?') }}</span>
                <flux:link :href="route('register')" wire:navigate>{{ __('Sign up') }}</flux:link>
            </div>
        @endif
    </div>

    <!-- Google reCAPTCHA v2 Checkbox Script -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        var recaptchaVerified = false;

        // Callback when reCAPTCHA is successfully verified
        function onRecaptchaSuccess(token) {
            recaptchaVerified = true;
            console.log('reCAPTCHA verified successfully with token:', token.substring(0, 20) + '...');
        }

        // Callback when reCAPTCHA expires
        function onRecaptchaExpired() {
            recaptchaVerified = false;
            console.log('reCAPTCHA has expired');
        }

        document.getElementById('login-form').addEventListener('submit', function(e) {
            // Check if reCAPTCHA was verified via callback
            if (!recaptchaVerified) {
                e.preventDefault();
                alert('{{ __("Please verify that you are not a robot.") }}');
                return false;
            }

            // Also verify that the textarea has the token
            var recaptchaTextarea = document.querySelector('textarea[name="g-recaptcha-response"]');
            if (!recaptchaTextarea || !recaptchaTextarea.value) {
                e.preventDefault();
                alert('{{ __("reCAPTCHA token missing. Please try again.") }}');
                return false;
            }

            console.log('Form submitted with reCAPTCHA token');
        });
    </script>
</x-layouts.auth>
