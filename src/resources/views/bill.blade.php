@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/bill.css') }}">
@endsection

@section('content')
<div class="bill-wrapper">
    <div class="bill__body">
        <h2 class="bill__header">請求額入力欄</h2>
        <form  class="bill__form" action="/bill/qr" method="post">
            @csrf
            <input class="bill__amount" name="amount" type="text" placeholder="金額">
            <div class="bill__button">
                <button class="bill__button-submit">
                    QRコード発行
                </button>
            </div>
        </form>
    </div>
</div>
@endsection