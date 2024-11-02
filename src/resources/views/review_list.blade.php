@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review_list.css') }}">
@endsection

@section('content')

@section('content')
<div class="review-list-wrapper">
    <div class="review-list__header">
        <h1>{{ $shop->shop_name }}</h1>
    </div>
    <div class="review-list-content">
        @foreach($reviews as $review)
        <div class="review-content">
            <div class="review-content__header">
                <div class="review-content__user">
                    {{ $review->user->name }}さん
                </div>
                @if(Auth::id() === $review->user_id)
                <div class="review-content__buttons">
                    <form class="review-content__button-form" action="/review/edit" method="get">
                        <input type="hidden" name="review_id" value="{{ $review->id }}">
                        <button class="review-content__button-form-submit">口コミを編集</button>
                    </form>
                    <form class="review-content__button-form" action="/review/delete" method="post">
                        @csrf
                        <input type="hidden" name="review_id" value="{{ $review->id }}">
                        <button class="review-content__button-form-submit">口コミを削除</button>
                    </form>
                </div>
                @endif
            </div>
            @if($review->review_img !== null)
            <div class="review-content__img">
                <img  src="{{ $review->review_img }}" alt="review_img">
            </div>
            @endif
            <div class="review-content__score">
                @for($num = 0; $num < $review->score; $num++)
                    <span class="material-symbols-outlined star-icon" style="color:#305dff;">star_rate</span>
                @endfor
                @for($num = $review->score; $num < 5; $num++)
                    <span class="material-symbols-outlined star-icon" style="color:#D8D8D8;">star_rate</span>
                @endfor
            </div>
            <p class="review-content__comment">{{ $review->comment }}</p>
        </div>
        @endforeach
    </div>
</div>
@endsection