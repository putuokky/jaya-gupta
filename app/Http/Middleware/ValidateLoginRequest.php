<?php

namespace App\Http\Middleware;

use App\Http\Requests\LoginRequest;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateLoginRequest
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('login') && $request->isMethod('post')) {
            $loginRequest = LoginRequest::createFrom($request);
            $loginRequest->validate();
        }

        return $next($request);
    }
}
