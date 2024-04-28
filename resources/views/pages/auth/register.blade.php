@extends('pages.auth.auth-template')
@section('title', 'Register')
@section('content')
@php
    $set = \App\Models\Setting::get()->first();
@endphp

<div class="card col-lg-4 mx-auto">
    <div class="card-body px-md-5 py-5">
        <h3 class="card-title text-center mb-3">{{ $set->app_name }}</h3>
        <hr>
        <h3 class="card-title">Sign Up</h3>
        <form method="post" action="">
            @csrf
            <div class="form-group">
                <label for="name">Name *</label>
                <input value="{{ old('name') }}" type="text" class="form-control p_input text-white" name="name" id="name">
                @error('name') <small class="fst-italic text-white" style="font-size: .7rem">{{ $message }}</small> @enderror
            </div>
            <div class="form-group">
                <label for="username">Username *</label>
                <input value="{{ old('username') }}" type="text" class="form-control p_input text-white" name="username" id="username">
                @error('username') <small class="fst-italic text-white" style="font-size: .7rem">{{ $message }}</small> @enderror
            </div>
            <div class="form-group">
                <label for="email">Email *</label>
                <input value="{{ old('email') }}" type="text" class="form-control p_input text-white" name="email" id="email">
                @error('email') <small class="fst-italic text-white" style="font-size: .7rem">{{ $message }}</small> @enderror
            </div>
            <div class="form-group">
                <label for="password">Password *</label>
                <div class="input-group">
                    <input type="password" class="form-control p_input text-white" name="password" id="password">
                    <div class="input-group-append" style="cursor: pointer" onclick="showPassword()">
                        <span class="input-group-text py-2">
                            <i class="mdi mdi-eye pt-1" id="eye-password"></i>
                        </span>
                    </div>
                </div>
                @error('password') <small class="fst-italic text-white" style="font-size: .7rem">{{ $message }}</small> @enderror
            </div>
            <div class="form-group">
                <label for="password_confirmation">Password Confirmation *</label>
                <div class="input-group">
                    <input type="password" class="form-control p_input text-white" name="password_confirmation" id="password_confirmation">
                    <div class="input-group-append" style="cursor: pointer" onclick="showConfirmPassword()">
                        <span class="input-group-text py-2">
                            <i class="mdi mdi-eye pt-1" id="eye-password-confirmation"></i>
                        </span>
                    </div>
                </div>
                @error('password_confirmation') <small class="fst-italic text-white" style="font-size: .7rem">{{ $message }}</small> @enderror
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-inverse-primary btn-sm w-100 py-2">Sign Up</button>
            </div>
            <hr>
            <div class="">
                <a href="{{ route('oauth.register', 'google') }}" class="w-100 mb-2 btn btn-outline-danger d-flex align-items-center justify-content-center"><i class="mdi mdi-google"></i> Sign Up with Google</a>
            </div>
            <p class="sign-up text-center">Already have an Account?<a href="{{ route('login') }}"> Sign In</a></p>
            <p class="terms">By creating an account you are accepting our<a href="#"> Terms & Conditions</a></p>
        </form>
    </div>
</div>
@endsection

