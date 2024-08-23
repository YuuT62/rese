@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_create.css') }}">
@endsection

@section('content')
    <div class="create-content">
        <h1 class="create-content__header">
            作成
        </h1>
        <form class="create-content__input" method="post" action="/shop/add" enctype="multipart/form-data">
            @csrf
            <div class="create-content__name">
                <input class="create-content__name-input" type="text" name="shop_name" placeholder="店舗名">
            </div>
            <div class="create-content__area">
                <select class="create-content__area-select" name="area_id">
                    <option value="" disabled selected>エリア</option>
                    <option value="1">東京都</option>
                    <option value="2">大阪府</option>
                    <option value="3">福岡県</option>
                </select>
                <img class="create-content__select-icon" src="{{ asset('storage/icon/select_icon.png') }}" alt="select_icon">
            </div>
            <div class="create-content__genre">
                <select class="create-content__genre-select" name="genre_id">
                    <option value="" disabled selected>ジャンル</option>
                    <option value="1">寿司</option>
                    <option value="2">焼肉</option>
                    <option value="3">居酒屋</option>
                    <option value="4">イタリアン</option>
                    <option value="5">ラーメン</option>
                </select>
                <img class="create-content__select-icon" src="{{ asset('storage/icon/select_icon.png') }}" alt="select_icon">
            </div>
            <div class="create-content__img">
                <label class="create-content__img-label" for="shop_img">店舗イメージ：</label></br>
                <input class="create-content__img-input" type="file" name="shop_img" id="shop_img">
            </div>
            <div class="create-content__overview">
                <textarea class="create-content__overview-input" name="overview" rows="10" placeholder="店舗概要入力欄"></textarea>
            </div>
            <div class="create-content__button">
                <button class="create-content__button-submit" type="submit">作成</button>
            </div>
        </form>
    </div>
</div>
@endsection