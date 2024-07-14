@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/done.css') }}">
@endsection

@section('content')
<div class="done-content">
    <div class="done-content__message">
        ご予約ありがとうございます
    </div>
    <div class="done-content__button">
        <a href="/">戻る</a>
    </div>
</div>
@endsection