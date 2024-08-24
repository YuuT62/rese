@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login-content">
    <form class="login-form" action="/login" method="post">
        @csrf
        <div class="login-form__header">
            Login
        </div>
        <div class="login-form__email">
            <img class="login-form__email-icon" src="{{ asset('storage/icon/mail_icon.png') }}" alt="mail_icon">
            <input type="text" name="email" value="{{ old('email') }}" placeholder="Email">
        </div>
        <div class="login-form__error">
            @error('email')
                <span>※</span>
                {{ $message }}
            @enderror
        </div>

        <div class="login-form__password">
            <img class="login-form__password-icon" src="{{ asset('storage/icon/password_icon.png') }}" alt="pass_icon">
            <input type="password" name="password" placeholder="Password">
        </div>
        <div class="login-form__error">
            @error('password')
                <span>※</span>
                {{ $message }}
            @enderror
        </div>

        <div class="login-form__button">
            <button>ログイン</button>
        </div>
    </form>
</div>
@endsection