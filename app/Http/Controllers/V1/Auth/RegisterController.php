<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    public function create(RegisterRequest $request)
    {
        $attributes = $request->validated();

        $user = User::create($attributes);
        $token = $user->createToken('authentication_token')->plainTextToken;

        return [
            'success' => true,
            'message' => __('auth.register.success'),
            'data' => [
                'version' => '1.0',
                'user' => $user,
                'token' => $token
            ]
        ];
    }
}
