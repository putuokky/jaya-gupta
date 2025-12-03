<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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

        // Log the token being validated
        Log::debug('reCAPTCHA token received', [
            'value_length' => strlen($value ?? ''),
            'value_empty' => empty($value),
        ]);

        if (empty($value)) {
            Log::warning('reCAPTCHA token is empty');
            $fail($attribute, __('Please verify that you are not a robot.'));
            return;
        }

        try {
            $payload = [
                'secret' => $recaptchaSecret,
                'response' => $value,
            ];

            Log::debug('Sending reCAPTCHA verification request', [
                'secret_length' => strlen($recaptchaSecret),
                'secret_first_20' => substr($recaptchaSecret, 0, 20),
                'token_length' => strlen($value),
                'token_first_50' => substr($value, 0, 50),
                'environment' => app()->environment(),
            ]);

            $response = Http::timeout(10)->post('https://www.google.com/recaptcha/api/siteverify', $payload);

            $body = $response->json();

            // Log response for debugging
            Log::debug('reCAPTCHA API response', [
                'status' => $response->status(),
                'success' => $body['success'] ?? null,
                'error-codes' => $body['error-codes'] ?? [],
                'challenge_ts' => $body['challenge_ts'] ?? null,
                'hostname' => $body['hostname'] ?? null,
            ]);

            if (!$response->successful()) {
                Log::error('reCAPTCHA API request failed', [
                    'status' => $response->status(),
                    'body' => $body,
                ]);
                $fail($attribute, __('reCAPTCHA verification failed.'));
                return;
            }

            if (!isset($body['success'])) {
                Log::error('reCAPTCHA response missing success field', [
                    'body' => $body,
                ]);
                $fail($attribute, __('reCAPTCHA verification failed.'));
                return;
            }

            if (!$body['success']) {
                $errorCodes = $body['error-codes'] ?? [];
                
                // Special handling for invalid-input-response in development
                if (in_array('invalid-input-response', $errorCodes) && app()->environment('local', 'development')) {
                    Log::warning('reCAPTCHA returned invalid-input-response in development environment', [
                        'error-codes' => $errorCodes,
                        'challenge_ts' => $body['challenge_ts'] ?? null,
                        'hostname' => $body['hostname'] ?? null,
                    ]);
                    // Skip reCAPTCHA verification in development for now
                    return;
                }
                
                Log::warning('reCAPTCHA verification returned false', [
                    'error-codes' => $errorCodes,
                    'challenge_ts' => $body['challenge_ts'] ?? null,
                    'hostname' => $body['hostname'] ?? null,
                ]);
                $fail($attribute, __('reCAPTCHA verification failed. Please try again.'));
                return;
            }

            Log::debug('reCAPTCHA verification successful');
        } catch (\Exception $e) {
            Log::error('reCAPTCHA verification exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            $fail($attribute, __('reCAPTCHA verification error. Please try again later.'));
        }
    }
}
