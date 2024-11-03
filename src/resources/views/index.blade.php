@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="{{ asset('css/search_box.css') }}">
<link rel="stylesheet" href="{{ asset('css/sort_box.css') }}">
<link rel="stylesheet" href="{{ asset('css/review.css') }}">
@endsection

@section('header')
<div class="box-wrapper">
    <form class="sort-box" action="/sort">
        <label class="sort-box__label" for="sort">
            <span>
                @if("1" === @$_GET["sort"])
                並び替え：ランダム
                @elseif("2" === @$_GET["sort"])
                並び替え：評価高/低
                @elseif("3" === @$_GET["sort"])
                並び替え：評価低/高
                @else
                並び替え：
                @endif
            </span>
        </label>
        <button type="button" id="sort" style="display:none"></button>
        <div class="sort-box__select" id="box" style="display:none">
            <input class="sort-box__select-radio"  type="radio" name="sort" value="1" id="random" onchange="this.form.submit">
            <button class="sort-box__select-button sort-box__select-button--random" @if("1" === @$_GET["sort"]) style="background-color:#5680F8" @endif>
                <label class="sort-box__select-label sort-box__select-label--random" for="random" @if("1" === @$_GET["sort"]) style="color:#fff" @endif>ランダム</label>
            </button>

            <input class="sort-box__select-radio" type="radio" name="sort" value="2" id="high" onchange="this.form.submit">
            <button class="sort-box__select-button" @if("2" === @$_GET["sort"]) style="background-color:#5680F8" @endif>
                <label class="sort-box__select-label" for="high" @if("2" === @$_GET["sort"]) style="color:#fff" @endif>評価が高い順</label>
            </button>

            <input class="sort-box__select-radio" type="radio" name="sort" value="3" id="low" onchange="this.form.submit">
            <button class="sort-box__select-button sort-box__select-button--low" @if("3" === @$_GET["sort"]) style="background-color:#5680F8" @endif>
                <label class="sort-box__select-label sort-box__select-label--low" for="low" @if("3" === @$_GET["sort"]) style="color:#fff" @endif>評価が低い順</label>
            </button>
        </div>
    </form>
    <form class="search-box" action="/search" method="get">
        <div class="search-box__area">
            <select name="area_id" onchange="this.form.submit()">
                <option value=" " selected>All area</option>
                <option value="1" @if("1" === @$_GET["area_id"]) selected @endif>東京都</option>
                <option value="2" @if("2" === @$_GET["area_id"]) selected @endif>大阪府</option>
                <option value="3" @if("3" === @$_GET["area_id"]) selected @endif>福岡県</option>
            </select>
            <img class="search-box__select-icon" src="{{ asset('storage/icon/select_icon.png') }}" alt="select_icon">
        </div>

        <div class="search-box__genre">
            <select name="genre_id" onchange="this.form.submit()">
                <option value=" " selected>All genre</option>
                <option value="1" @if("1" === @$_GET["genre_id"]) selected @endif>寿司</option>
                <option value="2" @if("2" === @$_GET["genre_id"]) selected @endif>焼肉</option>
                <option value="3" @if("3" === @$_GET["genre_id"]) selected @endif>居酒屋</option>
                <option value="4" @if("4" === @$_GET["genre_id"]) selected @endif>イタリアン</option>
                <option value="5" @if("5" === @$_GET["genre_id"]) selected @endif>ラーメン</option>
            </select>
            <img class="search-box__select-icon" src="{{ asset('storage/icon/select_icon.png') }}" alt="select_icon">
        </div>

        <div class="search-box__search">
            <img class="search-box__search-icon" src="{{ asset('storage/icon/search_icon.png') }}" alt="search_icon">
            <input type="text" name="keyword" value="<?php if(isset($keyword)){echo($keyword);}?>" placeholder="Search...">
        </div>
    </form>
</div>
@endsection

@section('content')
<div class="shop-content">
    @foreach($shops as $shop)
        <div class="shop-info">
            <div class="shop-info__img">
                <img src="{{ $shop->img }}" alt="shop-img">
            </div>
            <div class="shop-info__detail">
                <h2>{{ $shop->shop_name }}</h2>
                <p>#{{ $shop->area->area}} #{{ $shop->genre->genre }}</p>
                <div class="shop-info__buttons">
                    <form class="shop-info__button" action="/detail/{{$shop->id}}" method="get">
                        <button class="shop-info__button-submit" type="submit">詳しくみる</button>
                    </form>

                    <div class="review-shop-info__fav">
                        @if (!$shop->isFavoriteBy(Auth::user()))
                        <button class="review-shop-info__fav-button favorite-toggle" data-shop-id="{{ $shop->id }}" type="button">
                            <span class="material-symbols-outlined review-shop-info__fav-icon" id="{{$shop->id}}">favorite</span>
                        </button>
                        @else
                        <button class="review-shop-info__fav-button favorite-toggle" data-shop-id="{{ $shop->id }}" type="button">
                            <span class="material-symbols-outlined review-shop-info__fav-icon favorite-on" id="{{$shop->id}}">favorite</span>
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    const btn=document.getElementById("sort");
    const box=document.getElementById("box");
    btn.addEventListener('click', function(){
        if(box.style.display==="none"){
            box.style.display="block";
        }else{
            box.style.display="none";
        }
    });

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