@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/qrcode.css') }}">
@endsection

@section('content')
<div class="qrcode-content">
    <div class="qrcode-content__message">
        <?php
        $url=substr(url()->current(), 0, -7).'credit'.$amount;
        ?>
        <img src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(100)->generate($url)) }} " alt="camera">
    </div>
    <div class="qrcode-content__button">
        <a href="/management">管理画面に戻る</a>
    </div>
</div>
@endsection