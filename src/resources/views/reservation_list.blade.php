@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reservation_list.css') }}">
<link rel="stylesheet" href="{{ asset('css/search_box.css') }}">
@endsection

@section('content')
<div class="reservation-list">
    <h1 class="reservation-list__header">
        <a class="reservation-list__back" href="/management"><</a>
        {{ $shop->shop_name }}
    </h1>
    <table class="reservation-list-table">
        <tr class="reservation-list-table__row">
            <th class="reservation-list-table__header">お名前</th>
            <th class="reservation-list-table__header">日付</th>
            <th class="reservation-list-table__header">時間</th>
            <th class="reservation-list-table__header">予約詳細</th>
        </tr>
        @foreach($reservations as $reservation)
            <?php
            $date = explode(' ',$reservation->reservation)[0];
            $time = explode(' ',$reservation->reservation)[1];
            ?>
            <tr class="reservation-list-table__row">
                <td class="reservation-list-table__desc">
                    {{ $reservation->user->name }}
                </td>
                <td class="reservation-list-table__desc">
                    {{ $date }}
                </td>
                <td class="reservation-list-table__desc">
                    {{ substr($time, 0, -3) }}
                </td>
                <td class="reservation-list-table__desc">
                    <form class="reservation-list-table__form" action="/reservation_list/detail/{{ $reservation->id }}" method="get">
                        <button class="reservation-list-table__form-submit">詳細</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</div>
@endsection