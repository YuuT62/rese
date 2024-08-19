@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/done.css') }}">
@endsection

@section('content')
<div class="done-content">
    <div class="done-content__message">
        @isset($visit_status)
            @if($visit_status===0)
                ご来店ありがとうございます
            @else
                来店済みです
            @endif
        @else
            @if(parse_url(url()->previous(), PHP_URL_PATH) == "/reservation/edit")
            ご予約の変更を承りました
            @elseif(strpos(parse_url(url()->previous(), PHP_URL_PATH),'detail'))
            ご予約ありがとうございます
            @elseif(parse_url(url()->previous(), PHP_URL_PATH) == "/reservation/evaluation")
            ご評価ありがとうございます
            @else
            お支払いが完了しました
            @endif
        @endisset
    </div>
    <div class="done-content__button">
        <a href="/">戻る</a>
    </div>
</div>
@endsection