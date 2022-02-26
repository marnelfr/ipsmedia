<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function create(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (!auth()->attempt($credentials)) {
            return [
                'success' => false,
                'message' => __('auth.login.failed'),
                'data' => [
                    'version' => '1.0'
                ]
            ];
        }

        $user = auth()->user();
        $token = $user->createToken('authentication_token')->plainTextToken;

        return [
            'success' => true,
            'message' => __('auth.login.success'),
            'data' => [
                'version' => '1.0',
                'user' => $user,
                'token' => $token
            ]
        ];
    }
}
