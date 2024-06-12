@extends('pages.auth.auth-template')
@section('title', 'Forgot Password')
@section('content')
@php
    $set = \App\Models\Setting::get()->first();
@endphp

<div class="card col-lg-4 mx-auto">
    <div class="card-body px-md-5 py-5">
        <h3 class="card-title text-center mb-3">{{ $set->app_name }}</h3>
        <hr>
        <h3 class="card-title">Reset Password</h3>
        <form method="post" action="">
            @csrf
            <div class="form-group">
                <label for="password">Enter your new password *</label>
                <input placeholder="your password here" type="password" class="form-control p_input text-white" name="password" id="password">
                @error('password') <small class="fst-italic text-white">{{ $message }}</small> @enderror
            </div>
            <div class="form-group">
                <label for="password_confirmation">Enter your confirm of new password *</label>
                <input placeholder="your password confirmation here" type="password" class="form-control p_input text-white" name="password_confirmation" id="password_confirmation">
                @error('password_confirmation') <small class="fst-italic text-white">{{ $message }}</small> @enderror
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-inverse-primary btn-sm w-100 py-2">Reset Password</button>
            </div>
            <p class="sign-up text-center"><a href="{{ route('login') }}">Returned to Sign In Page</a></p>
        </form>
    </div>
</div>
@endsection

