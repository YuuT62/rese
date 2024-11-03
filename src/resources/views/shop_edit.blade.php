@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_edit.css') }}">
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="detail-wrapper">
    <div class="detail-content">
        <h1 class="detail-content__shop-name">
            <a class="detail-content__back" href="/management"><</a>
            {{ $shop->shop_name }}
        </h1>
        <div class="detail-content__shop-img">
            <img src="{{ $shop->img }}" alt="shop-img">
        </div>
        <p class="detail-content__shop-tag">
            #{{ $shop->area->area }} #{{ $shop->genre->genre}}
        </p>
        <p class="detail-content__shop-introduction">
            {{ $shop->overview }}
        </p>
    </div>

    <div class="edit-content">
        <h2 class="edit-content__header">
            編集
        </h2>
        <form class="edit-content__input" method="post" action="/update">
            @csrf
            <div class="edit-content__name">
                <input class="edit-content__name-input" type="text" name="shop_name" value="{{ $shop->shop_name }}">
            </div>

            <div class="edit-content__area">
                <select class="edit-content__area-select" name="area_id">
                    <option value="1" @if(1 === $shop->area_id) selected @endif>東京都</option>
                    <option value="2" @if(2 === $shop->area_id) selected @endif>大阪府</option>
                    <option value="3" @if(3 === $shop->area_id) selected @endif>福岡県</option>
                </select>
                <img class="edit-content__select-icon" src="{{ asset('storage/icon/select_icon.png') }}" alt="select_icon">
            </div>

            <div class="edit-content__genre">
                <select class="edit-content__genre-select" name="genre_id">
                    <option value="1" @if(1 === $shop->genre_id) selected @endif>寿司</option>
                    <option value="2" @if(2 === $shop->genre_id) selected @endif>焼肉</option>
                    <option value="3" @if(3 === $shop->genre_id) selected @endif>居酒屋</option>
                    <option value="4" @if(4 === $shop->genre_id) selected @endif>イタリアン</option>
                    <option value="5" @if(5 === $shop->genre_id) selected @endif>ラーメン</option>
                </select>
                <img class="edit-content__select-icon" src="{{ asset('storage/icon/select_icon.png') }}" alt="select_icon">
            </div>

            <div class="edit-content__overview">
                <textarea class="edit-content__overview-input" name="overview" rows="10" placeholder="店舗概要入力欄" value="{{ $shop->overview }}">{{ $shop->overview }}</textarea>
            </div>
            <div class="edit-content__button">
                <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                <button class="edit-content__button-submit" type="submit">修正</button>
            </div>
        </form>
    </div>
</div>



@endsection