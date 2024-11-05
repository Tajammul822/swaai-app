<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function register(Request $request)
    {

        $fields = $request->validate([
            'email' => 'required|email|unique:users',
            'role_id' => 'required|exists:roles,id',
            'password' => 'required|confirmed',
            
        ]);

        $fields['password'] = Hash::make($fields['password']);

        $user = User::create([
            'email' => $fields['email'],
            'password' => $fields['password'],
            'role_id' => $fields['role_id'],
        ]);

        $token = $user->createToken($request->email);

        return [
            'user' => $user,
            'token' => $token->plainTextToken
        ];
    }

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)) {

            return [
                'message' => 'The provided crendentials are incorrect.'
            ];
        }

        $token = $user->createToken($user->email);

        return [
            'user' => $user,
            'token' => $token->plainTextToken
        ];
    }

    public function logout(Request $request) {}
}
