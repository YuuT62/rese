@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="thanks-content">
    <div class="thanks-content__message">
        会員登録ありがとうございます
    </div>
    <div class="thanks-content__button">
        <a href="/login">ログインする</a>
    </div>
</div>
@endsection