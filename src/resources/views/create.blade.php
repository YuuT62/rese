@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register-content">
    <form class="register-form" action="/add" method="post">
        @csrf
        <h2 class="register-form__header">
        Store representative registration
        </h2>
        <div class="register-form__name">
            <img class="register-form__name-icon" src="{{ asset('storage/icon/name_icon.png') }}" alt="mail_icon">
            <input type="text" name="name" value="{{ old('name') }}" placeholder="Username">
        </div>
        <div class="register-form__error">
            @error('name')
                <span>※</span>
                {{ $message }}
            @enderror
        </div>

        <div class="register-form__email">
            <img class="register-form__email-icon" src="{{ asset('storage/icon/mail_icon.png') }}" alt="mail_icon">
            <input type="text" name="email" value="{{ old('email') }}" placeholder="Email">
        </div>
        <div class="register-form__error">
            @error('email')
                <span>※</span>
                {{ $message }}
            @enderror
        </div>

        <div class="register-form__password">
            <img class="register-form__password-icon" src="{{ asset('storage/icon/password_icon.png') }}" alt="mail_icon">
            <input type="password" name="password" placeholder="Password">
        </div>
        <div class="register-form__error">
            @error('password')
                <span>※</span>
                {{ $message }}
            @enderror
        </div>

        <div class="register-form__button">
            <button class="register-form__button-submit" type="submit">作成</button>
        </div>
    </form>
</div>

@endsection
