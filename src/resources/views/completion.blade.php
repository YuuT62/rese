@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/done.css') }}">
@endsection

@section('content')
<div class="done-content">
    <div class="done-content__message">
        @if(parse_url(url()->previous(), PHP_URL_PATH) === "/add")
        店舗代表者を作成しました
        @elseif(parse_url(url()->previous(), PHP_URL_PATH) === "/shop/add")
        新規店舗を作成しました
        @elseif(parse_url(url()->previous(), PHP_URL_PATH) === "/email")
        メールを送信しました
        @else
        店舗情報を修正しました
        @endif
    </div>
    <div class="done-content__button">
        <a href="/">戻る</a>
    </div>
</div>
@endsection