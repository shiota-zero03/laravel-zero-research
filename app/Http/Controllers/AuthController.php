<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resources\Rules\AuthRules;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;

use App\Models\User;
use App\Mail\AuthSendMail;
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
            Mail::to($request->email)->send(new AuthSendMail($create, 'Activation'));

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
        $hashData = base64_decode($hash);
        if(Hash::check($user->email, $hashData)){
            $user->markEmailAsVerified();
            return redirect()->route('login')->with('success_data', 'Your account has been activated');
        }
        abort(500);
    }
    public function forgot_password(Request $request)
    {
        $validation = $request->validate([
            'email' => 'required|email',
        ]);
        $user = User::where('email', $request->email)->first();
        if(!$user) return back()->with('error_data', 'Email not found');
        Mail::to($request->email)->send(new AuthSendMail($user, 'Reset'));
        return redirect()->route('login')->with('success_data', 'Please check your email to reset your password');
    }
    public function reset_password(Request $request, $id, $hash)
    {
        $user = User::findOrFail($id);
        $hashData = base64_decode($hash);
        if(Hash::check($user->email, $hashData)){
            return view('pages.auth.reset-password');
        }
        abort(500);
    }
    public function reset_password_submit(Request $request, $id)
    {
        $this->rules->__resetPasswordRules($request);
        $update = User::find($id)->update(['password', Hash::make($request->password)]);
        if($update){
            return redirect()->route('login')->with('success_data', 'Your password has been updated');
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->to(route('login'))->with('success_data', 'Anda berhasil logout');
    }
}
