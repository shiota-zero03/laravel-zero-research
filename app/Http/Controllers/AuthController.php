<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resources\Rules\AuthRules;
use Illuminate\Auth\Events\Registered;

use App\Models\User;
use Hash, Auth;

class AuthController extends Controller
{
    private $rules;
    public function __construct(AuthRules $rules)
    {
        $this->rules = $rules;
    }
    public function login_process(Request $request)
    {
        $this->rules->__loginRules($request);

        $attemptUsername = Auth::attempt(['username' => $request->username, 'password' => $request->password]);
        $attemptEmail = Auth::attempt(['email' => $request->username, 'password' => $request->password]);
        if($attemptUsername || $attemptEmail) {
            if(Auth::user()->email_verified_at){
                if($request->remember) {
                    setcookie('username', $request->username);
                    setcookie('password', base64_encode($request->password));
                } else {
                    setcookie('username', '');
                    setcookie('password', '');
                }
                if(Auth::user()->role == 1 || Auth::user()->role == 2) {
                    return redirect()->intended(route('admin.home'));
                } elseif(Auth::user()->role == 3) {
                    return redirect()->intended(route('user.home'));
                }
            } else {
                Auth::logout();
                return back()->with('error_data', 'Account is not active yet');
            }
        }
        return back()->with('error_data', 'Your username or password is wrong');
    }
    public function register_process(Request $request)
    {
        $this->rules->__registerRules($request);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 3,
        ];
        try {
            \DB::beginTransaction();

            $create = User::create($data);
            event(new Registered($create));

            \DB::commit();
            return redirect()->route('login')->with('success_data', 'Data register successfully, please check your email to activated this account');

        } catch (\Throwable $th) {
            \DB::rollback();
            return back()->with('error_data', 'Server error : '.$th->getMessage());
        }
        abort(500);
    }
    public function verification_email(Request $request, $id, $hash)
    {
        $user = User::findOrFail($id);
        if ($user && hash_equals($hash, sha1($user->email))) {
            $user->markEmailAsVerified();
            return redirect()->route('login')->with('success_data', 'Your account has been activated');
        }
        abort(500);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->to(route('login'))->with('success_data', 'Anda berhasil logout');
    }
}
