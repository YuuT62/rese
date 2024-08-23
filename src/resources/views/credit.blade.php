@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/credit.css') }}">
@endsection

@section('content')
<div class="credit-wrapper">
    <div class="credit__body">
        <div class="credit__amount">
            <table class="credit__amount-table">
                <tr>
                    <th class="credit__amount-term">請求額</th>
                    <td class="credit__amount-desc">{{ $amount }}円</td>
                </tr>
            </table>
        </div>
        <h2 class="credit__header">カード情報入力欄</h2>
        <form  class="credit__form" id="setup-form" action="/payment" method="post">
            @csrf
            <input id="card-holder-name" type="text" placeholder="カード名義人">
            <div id="card-element"></div>
            <input type="hidden" name="amount" value="{{ $amount }}">
            <button id="card-button">
                決済
            </button>
        </form>
    </div>
</div>
<script src="https://js.stripe.com/v3/"></script>
<script src="js/payment.js"></script>
@endsection
