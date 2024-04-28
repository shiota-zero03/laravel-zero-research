<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class TokenNotification extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function updateToken(Request $request)
    {
        if(Auth::user()){
            Auth::user()->update([
                'device_token' => $request->device_token
            ]);
            return response()->json([], 201);
        } else {
            return response()->json(['message' => 'Belum login'], 204);
        }
    }
}
