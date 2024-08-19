@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reservation_detail.css') }}">
@endsection

@section('content')
<div class="detail-wrapper">
    <div class="detail-content">
        <h2 class="detail-content__header">
            予約詳細
        </h2>
        <form class="detail-content__form" action="/reservation/confirm" method="post">
            @csrf
            <div class="detail-content__table-wrapper">
                <table class="detail-content__table">
                    <tr class="detail-content__table-row">
                        <th class="detail-content__table-header">店舗</th>
                        <td class="detail-content__table-desc">{{ $reservation->shop->shop_name }}</td>
                    </tr>
                    <tr class="detail-content__table-row">
                        <th class="detail-content__table-header">お名前</th>
                        <td class="detail-content__table-desc">{{ $reservation->user->name }}</td>
                    </tr>
                    <tr class="detail-content__table-row">
                        <th class="detail-content__table-header">日付</th>
                        <td class="detail-content__table-desc">{{ explode(' ',$reservation->reservation)[0] }}</td>
                    </tr>
                    <tr class="detail-content__table-row">
                        <th class="detail-content__table-header">時間</th>
                        <td class="detail-content__table-desc">{{ substr(explode(' ',$reservation->reservation)[1], 0, -3) }}</td>
                    </tr>
                    <tr class="detail-content__table-row">
                        <th class="detail-content__table-header">人数</th>
                        <td class="detail-content__table-desc">{{ $reservation->num_people }}人</td>
                    </tr>
                    <tr class="detail-content__table-row">
                        <th class="detail-content__table-header">予約日</th>
                        <td class="detail-content__table-desc">{{ explode(' ',$reservation->created_at)[0] }}</td>
                    </tr>
                </table>
            </div>
            <div class="detail-content__button">
                @if(parse_url(url()->previous(), PHP_URL_PATH) === "/reservation/confirm")
                    <input type="hidden" name="reservation-id" value="{{ $reservation->id }}">
                    <button class="detail-content__button-submit" type="submit">確認済みにする</button>
                @endif
            </div>
        </form>
    </div>
</div>
@endsection