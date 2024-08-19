@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/qrcode_confirm.css') }}">
@endsection

@section('content')
<div  class="qr-wrapper" id="wrapper">
    <form class="qr-form" action="" name="qrcode" >
        <video class="qr-form__video" id="video" autoplay muted playsinline></video>
        <canvas class="qr-form__camera"  id="camera-canvas"></canvas>
        <canvas class="qr-form__rect" id="rect-canvas"></canvas>
    </form>
    <p class="qr-form__text" id="qr-msg">QRコードが見つかりません</p>
</div>
<script src="{{ asset('js/jsQR.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>

@endsection