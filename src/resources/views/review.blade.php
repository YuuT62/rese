@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,1,-50..200&icon_names=star_rate" />
<link rel="stylesheet" href="{{ asset('css/review.css') }}">
@endsection

@section('content')
<div class="review-wrapper">
    <div class="review-shop">
        <h1 class="review-shop__header">今回のご利用はいかがでしたか？</h1>
        <div class="review-shop-info">
            <img class="review-shop-info__img" src="{{ asset('storage/shop-img/'.$shop->img) }}" alt="shop-img">
            <div class="review-shop-info__detail">
                <h2 class="review-shop-info__detail-header">{{ $shop->shop_name }}</h2>
                <p class="review-shop-info__detail-tag">#{{ $shop->area->area}} #{{ $shop->genre->genre }}</p>
                <div class="review-shop-info__buttons">
                    <form class="review-shop-info__form" action="/detail/{{$shop->id}}" method="get">
                        <button class="review-shop-info__form-submit" type="submit">詳しくみる</button>
                    </form>
                    <div class="review-shop-info__fav">
                        <button class="review-shop-info__fav-submit" type="submit">
                            @isset($favorite)
                                @if($favorite->status)
                                    <img src="{{ asset('storage/icon/fav_on_icon.png') }}" alt="fav_on_icon">
                                @else
                                    <img src="{{ asset('storage/icon/fav_off_icon.png') }}" alt="fav_off_icon">
                                @endif
                            @else
                            <img src="{{ asset('storage/icon/fav_off_icon.png') }}" alt="fav_off_icon">
                            @endisset
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form class="review-form" action="/review/send" method="post" enctype="multipart/form-data">
        @csrf
        <h2 class="review-form__header">体験を評価してください</h2>
        <div class="review-form__score">
            @for($i=1; $i<=5; $i++)
            <input type="radio" name="score" id="{{ $i }}" value="{{ $i }}" style="display:none" onchange="scoreChange()">
            <label for="{{ $i }}">
                <span class="material-symbols-outlined star-icon">star_rate</span>
            </label>
            @endfor
        </div>
        <h2 class="review-form__header">口コミを投稿</h2>
        <textarea class="review-form__text"  name="comment" id="text" placeholder="カジュアルな夜のお出かけにおすすめのスポット" onkeyup="countUp(this)"></textarea>
        <p class="review-form__text-counter">
        <span id="counter">0</span>
        <span>/400（最高文字数）</span>
        </p>
        <h2 class="review-form__header">画像の追加</h2>
        <div class="review-form__img">
            <input class="review-form__img-input" name="review_img" type="file" id="img" onchange="drop()">
            <label class="review-form__img-label" for="img" id="img-label">クリックして写真を追加</br>
            <span>またはドラッグアンドドロップ</span>
            </label>
        </div>
        <input type="hidden" name="shop_id" value="{{ $shop->id }}">
        <div class="review-form__button">
            <button class="review-form__button-submit" type="submit">口コミを投票</button>
        </div>
    </form>
</div>
<script>
    function scoreChange(){
        let score = document.getElementsByName('score');
        let len = score.length;
        let icon = document.getElementsByClassName('star-icon');
        for(let i = 0; i < len; i++){
            if(score.item(i).checked){
                for(let m = 0; m < score.item(i).value; m++){
                    icon[m].style.color="#305dff";
                }
                for(let n = score.item(i).value; n < len; n++){
                    icon[n].style.color="#D8D8D8";
                }
            }
        }
    }

    function countUp(obj){
        document.getElementById('counter').innerHTML = obj.value.length;
    }

    function drop(){
        document.getElementById('img-label').innerHTML=document.getElementById('img').files[0]['name'];
    }
</script>
@endsection