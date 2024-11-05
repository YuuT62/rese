@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review.css') }}">
@endsection

@section('content')
<div class="review-wrapper">
    <div class="review-shop">
        <h1 class="review-shop__header">今回のご利用はいかがでしたか？</h1>
        <div class="review-shop-info">
            <img class="review-shop-info__img" src="{{ $review->shop->img }}" alt="shop-img">
            <div class="review-shop-info__detail">
                <h2 class="review-shop-info__detail-header">{{ $review->shop->shop_name }}</h2>
                <p class="review-shop-info__detail-tag">#{{ $review->shop->area->area}} #{{ $review->shop->genre->genre }}</p>
                <div class="review-shop-info__buttons">
                    <form class="review-shop-info__form" action="/detail/{{$review->shop_id}}" method="get">
                        <button class="review-shop-info__form-submit" type="submit">詳しくみる</button>
                    </form>
                    <div class="review-shop-info__fav">
                        @if (!$review->shop->isFavoriteBy(Auth::user()))
                        <button class="review-shop-info__fav-button favorite-toggle" data-shop-id="{{ $review->shop_id }}" type="button">
                            <span class="material-symbols-outlined review-shop-info__fav-icon">favorite</span>
                        </button>
                        @else
                        <button class="review-shop-info__fav-button favorite-toggle" data-shop-id="{{ $review->shop_id }}" type="button">
                            <span class="material-symbols-outlined review-shop-info__fav-icon favorite-on">favorite</span>
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form class="review-form" action="/review/update" method="post" enctype="multipart/form-data">
        @csrf
        <h2 class="review-form__header">体験を評価してください</h2>
        <div class="review-form__score">
            <input type="hidden" value="
            <?php
            if(old('score')!== null){
                echo(old('score'));
            }else{
                echo($review->score);
            } ?>" id="old">
            @for($i=1; $i<=5; $i++)
            <input type="radio" name="score" id="{{ $i }}" value="{{ $i }}" style="display:none" onchange="scoreChange()" @if(old('score') == $i) checked @elseif($review->score === $i) checked @endif>
            <label for="{{ $i }}">
                <span class="material-symbols-outlined star-icon">star_rate</span>
            </label>
            @endfor
            <div class="error">
                @error('score')
                    {{ '※'.$message }}
                @enderror
            </div>
        </div>
        <h2 class="review-form__header">口コミを投稿</h2>
        <textarea class="review-form__text"  name="comment" id="textarea" placeholder="カジュアルな夜のお出かけにおすすめのスポット">{{ $review->comment }}</textarea>
        <p class="review-form__text-counter" >
        <span id="counter"></span>
        <span>/400（最高文字数）</span>
        </p>
        <div class="error">
            @error('comment')
                {{ '※'.$message }}
            @enderror
        </div>
        <h2 class="review-form__header">画像の追加</h2>
        <div class="review-form__old-img">
            <label for="">保存されている画像：</label>
            @if($review->review_img !== null)
                <img src="{{ $review->review_img }}" alt="old-review-img">
            @else
                <span>なし</span>
            @endif
        </div>
        <div class="review-form__img">
            <input class="review-form__img-input" name="review_img" type="file" id="img" onchange="drop()">
            <label class="review-form__img-label" for="img" id="imgLabel">クリックして写真を追加</br>
            <span>またはドラッグアンドドロップ</span>
            </label>
        </div>
        <div class="error">
                @error('review_img')
                    {{ '※'.$message }}
                @enderror
            </div>
        <input type="hidden" name="review_id" value="{{ $review->id }}">
        <div class="review-form__button">
            <button class="review-form__button-submit" type="submit">口コミを編集</button>
        </div>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // 評価用星
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

    window.onload = function(){
        let score = document.getElementsByName('score');
        let len = score.length;
        let old = document.getElementById('old').value;
        let icon = document.getElementsByClassName('star-icon');
        for(let i = 0; i < len; i++){
            for(let m = 0; m < old; m++){
                icon[m].style.color="#305dff";
            }
        }
    }

    // テキストカウンター
    const textarea = document.getElementById("textarea");
    const charCounter = document.getElementById("counter");
    let currentLength = textarea.value.length;
    const maxLength = 400;
    charCounter.textContent = `${currentLength}`
    textarea.addEventListener("input", () => {
    currentLength = textarea.value.length
    charCounter.textContent = `${currentLength}`
    if (currentLength > maxLength) {
        charCounter.style.color = "red"
    } else {
        charCounter.style.removeProperty("color")
    }
    });

    // 画像追加ボックス
    function drop(){
        document.getElementById('imgLabel').innerHTML=document.getElementById('img').files[0]['name'];
    }

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
            $('.review-shop-info__fav-icon').toggleClass('favorite-on');
            })
            // 通信失敗した時の処理
            .fail(function () {
            console.log('fail');
            });
        });
    });
</script>
@endsection