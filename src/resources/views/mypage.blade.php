@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
<link rel="stylesheet" href="{{ asset('css/review.css') }}">
@endsection

@section('header')
<div class="mypage-header">
    <form class="mypage-header__button" action="/credit/confirm" method="get">
        <button class="mypage-header__button-submit" type="submit">QR読み取り</button>
    </form>
</div>
@endsection


@section('content')

<div class="mypage-wrapper">
    <h1 class="mypage-name">
        {{ $user_name }}さん
    </h1>
    <div class="mypage-content">
        <div class="reservation-status">
            <h2 class="reservation-status__header">
                予約状況
            </h2>
            <?php $num=1; ?>
            <div class="reservation-status__wrapper">
                @foreach($reservations as $reservation)
                    <div class="reservation-status__detail">
                        <div class="reservation-status__detail-header">
                            <div class="reservation-status__detail-num">
                                <img src="{{ asset('storage/icon/clock_icon.png') }}" alt="clock_icon">
                                <span>予約{{ $num++}}</span>
                            </div>
                            <div class="reservation-status__button">
                                <form class="reservation-status__detail-delete" action="/reservation/delete" method="post">
                                    @csrf
                                    <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
                                    <button>✕</button>
                                </form>
                            </div>
                        </div>
                        <table class="reservation-content__result">
                            <tr>
                                <th>Shop</th>
                                <td>{{ $reservation->shop->shop_name }}</td>
                            </tr>
                            <?php
                            $date = explode(' ',$reservation->reservation)[0];
                            $time = explode(' ',$reservation->reservation)[1];
                            ?>
                            <tr>
                                <th>Date</th>
                                <td>{{ $date }}</td>
                            </tr>
                            <tr>
                                <th>Time</th>
                                <td>{{ substr($time, 0, -3) }}</td>
                            </tr>
                            <tr>
                                <th>Number</th>
                                <td>{{ $reservation->num_people.'人' }}</td>
                            </tr>
                        </table>
                        <div class="reservation-status__button">
                            <!-- qrボタン -->
                            @if($reservation->visit_status == false)
                            <form class="reservation-status__evaluation" action="/reservation/qr" method="post">
                                @csrf
                                <input type="hidden" name="reservation_id" value="{{$reservation->id}}">
                                <button class="reservation-status__evaluation-submit">QRコード</button>
                            </form>
                            <form class="reservation-status__change" action="/reservation/edit" method="get">
                                <input type="hidden" name="reservation_id" value="{{$reservation->id}}">
                                <button class="reservation-status__change-submit">変更</button>
                            </form>
                            @else
                                @if($reservation->evaluation_status == false)
                                <form class="reservation-status__evaluation" action="/reservation/evaluation" method="post">
                                    @csrf
                                    <input type="hidden" name="reservation_id" value="{{$reservation->id}}">
                                    <button class="reservation-status__evaluation-submit">評価</button>
                                </form>
                                @else
                                <div class="reservation-status__evaluation">
                                    <button class="reservation-status__evaluation-submit--true">評価済み</button>
                                </div>
                                @endif
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="favorite-content">
            <h2 class="favorite-content__header">
                お気に入り店舗
            </h2>
            <div class="shop-wrapper">
                @foreach($favorites as $favorite)
                    <div class="shop-info">
                        <div class="shop-info__img">
                            <img src="{{ $favorite->shop->img }}" alt="shop-img">
                        </div>
                        <div class="shop-info__detail">
                            <h2>{{ $favorite->shop->shop_name }}</h2>
                            <p>#{{ $favorite->shop->area->area }} #{{ $favorite->shop->genre->genre }}</p>
                            <div class="shop-info__button">
                                <form class="shop-info__button--detail" action="/detail/{{$favorite->shop->id}}" method="get">
                                    <button class="shop-info__button--detail-submit" type="submit">詳しくみる</button>
                                </form>
                                <div class="review-shop-info__fav">
                                    @if (!$favorite->shop->isFavoriteBy(Auth::user()))
                                    <button class="review-shop-info__fav-button favorite-toggle" data-shop-id="{{ $favorite->shop_id }}" type="button">
                                        <span class="material-symbols-outlined review-shop-info__fav-icon" id="{{$$favorite-shop->id}}">favorite</span>
                                    </button>
                                    @else
                                    <button class="review-shop-info__fav-button favorite-toggle" data-shop-id="{{ $favorite->shop_id }}" type="button">
                                        <span class="material-symbols-outlined review-shop-info__fav-icon favorite-on" id="{{$favorite->shop_id}}">favorite</span>
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // いいねボタン
    $(function () {
        let favorite = $('.favorite-toggle');
        favorite.on('click', function () {
            let $this = $(this);
            let favoriteShopId = $this.data('shop-id');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                },
                url: '/favorite',
                method: 'POST',
                data: {
                    'shop_id': favoriteShopId
                },
            })
            //通信成功した時の処理
            .done(function (data) {
            $('#'+favoriteShopId).toggleClass('favorite-on');
            })
            // 通信失敗した時の処理
            .fail(function () {
            console.log('fail');
            });
        });
    });
</script>
@endsection