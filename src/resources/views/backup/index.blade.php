@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="{{ asset('css/search_box.css') }}">
@endsection

@section('header')
<form class="search-box" action="/search" method="get">
    <div class="search-box__area">
        <select name="area-id" onchange="this.form.submit()">
            <option value=" " selected>All area</option>
            <option value="1" @if("1" === @$_GET["area-id"]) selected @endif>東京都</option>
            <option value="2" @if("2" === @$_GET["area-id"]) selected @endif>大阪府</option>
            <option value="3" @if("3" === @$_GET["area-id"]) selected @endif>福岡県</option>
        </select>
        <img class="search-box__select-icon" src="{{ asset('storage/icon/select_icon.png') }}" alt="select_icon">
    </div>

    <div class="search-box__genre">
        <select name="genre-id" onchange="this.form.submit()">
            <option value=" " selected>All genre</option>
            <option value="1" @if("1" === @$_GET["genre-id"]) selected @endif>寿司</option>
            <option value="2" @if("2" === @$_GET["genre-id"]) selected @endif>焼肉</option>
            <option value="3" @if("3" === @$_GET["genre-id"]) selected @endif>居酒屋</option>
            <option value="4" @if("4" === @$_GET["genre-id"]) selected @endif>イタリアン</option>
            <option value="5" @if("5" === @$_GET["genre-id"]) selected @endif>ラーメン</option>
        </select>
        <img class="search-box__select-icon" src="{{ asset('storage/icon/select_icon.png') }}" alt="select_icon">
    </div>

    <div class="search-box__search">
        <img class="search-box__search-icon" src="{{ asset('storage/icon/search_icon.png') }}" alt="mail_icon">
        <input type="text" name="keyword" value="<?php if(isset($keyword)){echo($keyword);}?>" placeholder="Search...">
    </div>
</form>
@endsection

@section('content')
<div class="shop-content">
    @foreach($shops as $shop)
        <div class="shop-info">
            <div class="shop-info__img">
                <img src="{{ asset('storage/shop-img/'.$shop->img) }}" alt="shop-img">
            </div>
            <div class="shop-info__detail">
                <h2>{{ $shop->shop_name }}</h2>
                <p>#{{ $shop->area->area}} #{{ $shop->genre->genre }}</p>
                <div class="shop-info__buttons">
                    @can('user')
                        <form class="shop-info__button" action="/detail/{{$shop->id}}" method="get">
                            <button class="shop-info__button-submit" type="submit">詳しくみる</button>
                        </form>
                    @endcan
                    @can('representative')
                        <form class="shop-info__button" action="/reservation-list/{{$shop->id}}" method="get">

                            <button class="shop-info__button-submit" type="submit">予約情報</button>
                        </form>
                        <form class="shop-info__button" action="/edit/{{$shop->id}}" method="get">
                            <button class="shop-info__button-submit" type="submit">修正</button>
                        </form>
                    @endcan

                    @can('user')
                    <form class="shop-info__button--fav" action="/" method="post">
                        @csrf
                        <input type="hidden" name="shop-id" value="{{ $shop->id }}">
                        <button class="shop-info__button--fav-submit" type="submit">
                            <?php $fav_boolean=true; ?>
                            @foreach($favorites as $favorite)
                                @if($shop->id === $favorite->shop_id && $favorite->status===1)
                                    <img src="{{ asset('storage/icon/fav_on_icon.png') }}" alt="fav_on_icon">
                                    <?php $fav_boolean=false; ?>
                                    @break
                                @endif
                            @endforeach
                            @if($fav_boolean)
                                <img src="{{ asset('storage/icon/fav_off_icon.png') }}" alt="fav_off_icon">
                            @endif
                        </button>
                    </form>
                    @endcan
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection