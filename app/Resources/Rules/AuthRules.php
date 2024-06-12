<?php

namespace App\Resources\Rules;

use Illuminate\Http\Request;

class AuthRules
{
    public function __loginRules(Request $request)
    {
        return $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);
    }
    public function __registerRules(Request $request)
    {
        return $request->validate([
            'name' => 'required|string',
            'username' => 'required|string|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|confirmed',
            'password_confirmation' => 'required|string',
        ]);
    }
    public function __resetPasswordRules(Request $request)
    {
        return $request->validate([
            'password' => 'required|string|confirmed',
            'password_confirmation' => 'required|string',
        ]);
    }
}
