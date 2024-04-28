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
        <h3 class="card-title">Forgot Password</h3>
        <form>
            <div class="form-group">
                <label for="username">Enter your email *</label>
                <input placeholder="your email here" type="text" class="form-control p_input text-white" name="username" id="username">
                @error('username') <small class="fst-italic text-white">{{ $message }}</small> @enderror
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-inverse-primary btn-sm w-100 py-2">Reset Password</button>
            </div>
            <p class="sign-up text-center"><a href="{{ route('login') }}">Returned to Sign In Page</a></p>
        </form>
    </div>
</div>
@endsection

