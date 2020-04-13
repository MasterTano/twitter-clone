<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginAuthenticateRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param LoginAuthenticateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function authenticate(LoginAuthenticateRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'success',
                'token' => Auth::user()->createToken('token-name')->plainTextToken
            ]);
        }

        return response()->json(['message' => 'Invalid credentials' ], Response::HTTP_UNAUTHORIZED);
    }
}
