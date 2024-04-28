<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

use App\Models\User;

class AuthSSOController extends Controller
{
    public function redirect_register(Request $request)
    {
        return Socialite::driver($request->driver)->redirect();
    }
    public function redirect_login(Request $request)
    {
        return Socialite::driver($request->driver)->redirect();
    }
    public function callback(Request $request)
    {
        $userFromGoogle = Socialite::driver('google')->user();
            return $userFromGoogle->getId();
        // try {
        //     // $datauser = ;

        //     dd(Socialite::driver($request->driver));
        // } catch (\Exception $e) {
        //     return response()->json([
        //         "data" => $e,
        //         "message" => "server error".$e->getMessage()
        //     ], 500);
        // }
            // if(session('auth_process') == 'register'){
            //     $check_email = User::where('email', $datauser->email)->first();
            //     if($check_email) return redirect()->route('login')->with('error_data', 'Account has been used');
            //     else {
            //         $data = [
            //             'name' => $datauser->name,
            //             'email' => $datauser->email,
            //             'username' => $datauser->nickname,
            //             'password' => \Hash::make('ssopassword'),
            //             'profile_picture' => $datauser->avatar,
            //             'sso' => 'google',
            //             'email_verified_at' => now(),
            //             'role' => 3,
            //         ];
            //         $create = User::create($data);
            //         if($create) {
            //             session()->forget('auth_process');
            //             return redirect()->route('login')->with('success_data', 'Data register successfully, please check your email to activated this account');
            //         }
            //     }
            // } elseif (session('auth_process') == 'login'){
            //     $check_email = User::where('email', $datauser->email)->first();
            //     if(!$check_email) return redirect()->route('login')->with('error_data', 'Email not found');
            //     else {
            //         if($check_email->sso !== $request->driver) return redirect()->route('login')->with('error_data', 'Your account is not using '.$request->driver.' sso');
            //     }
            //     session()->forget('auth_process');
            //     return $check_email;
            // }
    }
}
