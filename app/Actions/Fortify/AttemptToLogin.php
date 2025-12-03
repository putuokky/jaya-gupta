<?php

namespace App\Actions\Fortify;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\LoginResponse;

class AttemptToLogin
{
    /**
     * Attempt to authenticate a user and emit the authenticated response.
     */
    public function __invoke(LoginRequest $request): LoginResponse
    {
        // Validate the request (includes reCAPTCHA validation)
        $request->validate();

        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => __('These credentials do not match our records.'),
            ]);
        }

        return app(LoginResponse::class);
    }
}
