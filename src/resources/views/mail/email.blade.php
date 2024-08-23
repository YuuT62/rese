@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/email.css') }}">
@endsection

@section('content')
    <div class="email-content">
        <h2 class="email-content__header">
            メール作成
        </h2>
        <form class="email-content__input" method="post" action="/email">
            @csrf
            <div class="email-content__subject">
                <input class="email-content__subject-input" type="text" name="subject" value="{{ old('subject') }}" placeholder="件名">
                <p class="email-content__error">
                @error('subject')
                    {{ $message }}
                @enderror
                </p>
            </div>
            <div class="email-content__message">
                <textarea class="email-content__message-input" name="message" rows="10" placeholder="本文">{{ old('message') }}</textarea>
                <p class="email-content__error">
                @error('message')
                    {{ $message }}
                @enderror
                </p>
            </div>
            <div class="email-content__button">
                <button class="email-content__button-submit" type="submit">送信</button>
            </div>
        </form>
    </div>
</div>



@endsection