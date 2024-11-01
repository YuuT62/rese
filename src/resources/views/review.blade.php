@extends('layouts.app')

@section('css')

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
                        @if (!$shop->isFavoriteBy(Auth::user()))
                        <button class="review-shop-info__fav-button favorite-toggle" data-shop-id="{{ $shop->id }}" type="button">
                            <span class="material-symbols-outlined review-shop-info__fav-icon">favorite</span>
                        </button>
                        @else
                        <button class="review-shop-info__fav-button favorite-toggle" data-shop-id="{{ $shop->id }}" type="button">
                            <span class="material-symbols-outlined review-shop-info__fav-icon favorite-on">favorite</span>
                        </button>
                        @endif
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
            <div class="error">
                @error('score')
                    {{ '※'.$message }}
                @enderror
            </div>
        </div>
        <h2 class="review-form__header">口コミを投稿</h2>
        <textarea class="review-form__text"  name="comment" id="textarea" placeholder="カジュアルな夜のお出かけにおすすめのスポット">{{ old('comment')}}</textarea>
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
        <div class="review-form__img">
            <input class="review-form__img-input" name="review_img" type="file" id="img" onchange="drop()" value="{{ old('review_img')}}">
            <label class="review-form__img-label" for="img" id="img-label">クリックして写真を追加</br>
            <span>またはドラッグアンドドロップ</span>
            </label>
        </div>
        <div class="error">
                @error('review_img')
                    {{ '※'.$message }}
                @enderror
            </div>
        <input type="hidden" name="shop_id" value="{{ $shop->id }}">
        <div class="review-form__button">
            <button class="review-form__button-submit" type="submit">口コミを投稿</button>
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

    // テキストカウンター
    const textarea = document.getElementById("textarea");
    const charCounter = document.getElementById("counter");
    const maxLength = 400;
    charCounter.textContent = `0`
    textarea.addEventListener("input", () => {
    const currentLength = textarea.value.length
    charCounter.textContent = `${currentLength}`

    if (currentLength > maxLength) {
        charCounter.style.color = "red"
    } else {
        charCounter.style.removeProperty("color")
    }
    });

    // 画像追加ボックス
    function drop(){
        document.getElementById('img-label').innerHTML=document.getElementById('img').files[0]['name'];
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