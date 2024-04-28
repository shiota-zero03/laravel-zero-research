@extends('pages.auth.auth-template')
@section('title', 'Login')
@section('content')
@php
    $set = \App\Models\Setting::get()->first();
@endphp

<div class="card col-lg-4 mx-auto">
    <div class="card-body px-md-5 py-5">
        <h3 class="card-title text-center mb-3">{{ $set->app_name }}</h3>
        <hr>
        <h3 class="card-title">Sign In</h3>
        <form action="" method="post">
            @csrf
            <div class="form-group">
                <label for="username">Email or Username *</label>
                <input placeholder="your email here" type="text" class="form-control p_input text-white" name="username" id="username" value="{{ isset($_COOKIE['username']) ? $_COOKIE['username'] : '' }}">
                @error('username') <small class="fst-italic text-white" style="font-size: .7rem">{{ $message }}</small> @enderror
            </div>
            <div class="form-group">
                <label>Password *</label>
                <div class="input-group">
                    <input placeholder="your password here" type="password" class="form-control p_input text-white" name="password" id="password" value="{{ isset($_COOKIE['password']) ? base64_decode($_COOKIE['password']) : '' }}">
                    <div class="input-group-append" style="cursor: pointer" onclick="showPassword()">
                        <span class="input-group-text py-2">
                            <i class="mdi mdi-eye pt-1" id="eye-password"></i>
                        </span>
                    </div>
                </div>
                @error('password') <small class="fst-italic text-white" style="font-size: .7rem">{{ $message }}</small> @enderror
            </div>
            <div class="form-group d-md-flex align-items-center justify-content-between">
                <div class="form-check">
                    <label class="form-check-label">
                    <input @if(isset($_COOKIE['username']) && isset($_COOKIE['password'])) checked="checked" @endif type="checkbox" class="form-check-input" name="remember"> Remember me </label>
                </div>
                <div class="text-end">
                    <a href="{{ route('forgot-password') }}" class="forgot-pass">Forgot password</a>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-inverse-primary btn-sm w-100 py-2">Sign In</button>
            </div>
            <hr>
            <div class="">
                <a target="__blank" href="{{ route('oauth.login', 'google') }}" class="w-100 mb-2 btn btn-outline-danger d-flex align-items-center justify-content-center"><i class="mdi mdi-google"></i> Sign In with Google</a>
            </div>
            <p class="sign-up">Don't have an Account ?<a href="{{ route('register') }}"> Sign Up</a></p>
        </form>
    </div>
</div>
@endsection
