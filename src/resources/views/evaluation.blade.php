@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/evaluation.css') }}">
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="detail-wrapper">
    <div class="detail-content">
        <h2 class="detail-content__shop-name">
            <a class="detail-content__back" href="/"><</a>
            {{ $shop->shop_name }}
        </h2>
        <div class="detail-content__shop-img">
            <img src="{{ asset('storage/shop-img/'.$shop->img) }}" alt="shop-img">
        </div>
        <p class="detail-content__shop-tag">
            #{{ $shop->area->area }} #{{ $shop->genre->genre}}
        </p>
        <p class="detail-content__shop-introduction">
            {{ $shop->overview }}
        </p>
    </div>

    <div class="evaluation-content">
        <h2 class="evaluation-content__header">
            評価入力欄
        </h2>
        <form class="evaluation-content__input" method="post" action="/reservation/evaluation">
            @csrf
            <input type="hidden" name="reservation-id" value="{{ $reservation->id }} ">
            <table class="evaluation-content__table">
                <tr class="evaluation-content__row">
                    <th class="evaluation-content__grade-title">総合</th>
                    <td class="evaluation-content__table-grade">
                        <label class="evaluation-content__grade-label" for="evaluation-grade-general-1">
                            <input class="evaluation-content__grade-input grade-1" type="radio" name="evaluation-grade-general" value=1 id="evaluation-grade-general-1" onchange="this.form.submit()" @if(@$_POST["evaluation-grade-general"] === '1') checked @endif>
                            @if(@$_POST["evaluation-grade-general"] >= 1)
                            <img class="evaluation-content__grade-icon--on grade-on-1" src="{{ asset('storage/icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon--off grade-off-1" src="{{ asset('storage/icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>

                        <label class="evaluation-content__grade-label" for="evaluation-grade-general-2">
                            <input class="evaluation-content__grade-input grade-2" type="radio" name="evaluation-grade-general" value=2 id="evaluation-grade-general-2" onchange="this.form.submit()" @if(@$_POST["evaluation-grade-general"] === '2') checked @endif>
                            @if(@$_POST["evaluation-grade-general"] >= 2)
                            <img class="evaluation-content__grade-icon--on grade-on-2" src="{{ asset('storage/icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon--off grade-off-2" src="{{ asset('storage/icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>

                        <label class="evaluation-content__grade-label" for="evaluation-grade-general-3">
                            <input class="evaluation-content__grade-input grade-3" type="radio" name="evaluation-grade-general" value=3 id="evaluation-grade-general-3" onchange="this.form.submit()" @if(@$_POST["evaluation-grade-general"] === '3') checked @endif>
                            @if(@$_POST["evaluation-grade-general"] >= 3)
                            <img class="evaluation-content__grade-icon--on grade-on-3" src="{{ asset('storage/icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon--off grade-off-3" src="{{ asset('storage/icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>

                        <label class="evaluation-content__grade-label" for="evaluation-grade-general-4">
                            <input class="evaluation-content__grade-input grade-4" type="radio" name="evaluation-grade-general" value=4 id="evaluation-grade-general-4" onchange="this.form.submit()" @if(@$_POST["evaluation-grade-general"] === '4') checked @endif>
                            @if(@$_POST["evaluation-grade-general"] >= 4)
                            <img class="evaluation-content__grade-icon--on grade-on-4" src="{{ asset('storage/icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon--off grade-off-4" src="{{ asset('storage/icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>

                        <label class="evaluation-content__grade-label" for="evaluation-grade-general-5">
                            <input class="evaluation-content__grade-input grade-5" type="radio" name="evaluation-grade-general" value=5 id="evaluation-grade-general-5" onchange="this.form.submit()" @if(@$_POST["evaluation-grade-general"] === '5') checked @endif>
                            @if(@$_POST["evaluation-grade-general"] >= 5)
                            <img class="evaluation-content__grade-icon--on grade-on-5" src="{{ asset('storage/icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon--off grade-off-5" src="{{ asset('storage/icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>
                    </td>
                </tr>

                <tr class="evaluation-content__row">
                    <th class="evaluation-content__grade-title">食事</th>
                    <td class="evaluation-content__table-grade">
                        <label class="evaluation-content__grade-label" for="evaluation-grade-meal-1">
                            <input class="evaluation-content__grade-input grade-1" type="radio" name="evaluation-grade-meal" value=1 id="evaluation-grade-meal-1" onchange="this.form.submit()" @if(@$_POST["evaluation-grade-meal"] === '1') checked @endif>
                            @if(@$_POST["evaluation-grade-meal"] >= 1)
                            <img class="evaluation-content__grade-icon--on grade-on-1" src="{{ asset('storage/icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon--off grade-off-1" src="{{ asset('storage/icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>

                        <label class="evaluation-content__grade-label" for="evaluation-grade-meal-2">
                            <input class="evaluation-content__grade-input grade-2" type="radio" name="evaluation-grade-meal" value=2 id="evaluation-grade-meal-2" onchange="this.form.submit()" @if(@$_POST["evaluation-grade-meal"] === '2') checked @endif>
                            @if(@$_POST["evaluation-grade-meal"] >= 2)
                            <img class="evaluation-content__grade-icon--on grade-on-2" src="{{ asset('storage/icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon--off grade-off-2" src="{{ asset('storage/icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>

                        <label class="evaluation-content__grade-label" for="evaluation-grade-meal-3">
                            <input class="evaluation-content__grade-input grade-3" type="radio" name="evaluation-grade-meal" value=3 id="evaluation-grade-meal-3" onchange="this.form.submit()" @if(@$_POST["evaluation-grade-meal"] === '3') checked @endif>
                            @if(@$_POST["evaluation-grade-meal"] >= 3)
                            <img class="evaluation-content__grade-icon--on grade-on-3" src="{{ asset('storage/icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon--off grade-off-3" src="{{ asset('storage/icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>

                        <label class="evaluation-content__grade-label" for="evaluation-grade-meal-4">
                            <input class="evaluation-content__grade-input grade-4" type="radio" name="evaluation-grade-meal" value=4 id="evaluation-grade-meal-4" onchange="this.form.submit()" @if(@$_POST["evaluation-grade-meal"] === '4') checked @endif>
                            @if(@$_POST["evaluation-grade-meal"] >= 4)
                            <img class="evaluation-content__grade-icon--on grade-on-4" src="{{ asset('storage/icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon--off grade-off-4" src="{{ asset('storage/icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>

                        <label class="evaluation-content__grade-label" for="evaluation-grade-meal-5">
                            <input class="evaluation-content__grade-input grade-5" type="radio" name="evaluation-grade-meal" value=5 id="evaluation-grade-meal-5" onchange="this.form.submit()" @if(@$_POST["evaluation-grade-meal"] === '5') checked @endif>
                            @if(@$_POST["evaluation-grade-meal"] >= 5)
                            <img class="evaluation-content__grade-icon--on grade-on-5" src="{{ asset('storage/icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon--off grade-off-5" src="{{ asset('storage/icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>
                    </td>
                </tr>

                <tr class="evaluation-content__row">
                    <th class="evaluation-content__grade-title">サービス</th>
                    <td class="evaluation-content__table-grade">
                        <label class="evaluation-content__grade-label" for="evaluation-grade-service-1">
                            <input class="evaluation-content__grade-input grade-1" type="radio" name="evaluation-grade-service" value=1 id="evaluation-grade-service-1" onchange="this.form.submit()" @if(@$_POST["evaluation-grade-service"] === '1') checked @endif>
                            @if(@$_POST["evaluation-grade-service"] >= 1)
                            <img class="evaluation-content__grade-icon--on grade-on-1" src="{{ asset('storage/icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon--off grade-off-1" src="{{ asset('storage/icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>

                        <label class="evaluation-content__grade-label" for="evaluation-grade-service-2">
                            <input class="evaluation-content__grade-input grade-2" type="radio" name="evaluation-grade-service" value=2 id="evaluation-grade-service-2" onchange="this.form.submit()" @if(@$_POST["evaluation-grade-service"] === '2') checked @endif>
                            @if(@$_POST["evaluation-grade-service"] >= 2)
                            <img class="evaluation-content__grade-icon--on grade-on-2" src="{{ asset('storage/icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon--off grade-off-2" src="{{ asset('storage/icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>

                        <label class="evaluation-content__grade-label" for="evaluation-grade-service-3">
                            <input class="evaluation-content__grade-input grade-3" type="radio" name="evaluation-grade-service" value=3 id="evaluation-grade-service-3" onchange="this.form.submit()" @if(@$_POST["evaluation-grade-service"] === '3') checked @endif>
                            @if(@$_POST["evaluation-grade-service"] >= 3)
                            <img class="evaluation-content__grade-icon--on grade-on-3" src="{{ asset('storage/icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon--off grade-off-3" src="{{ asset('storage/icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>

                        <label class="evaluation-content__grade-label" for="evaluation-grade-service-4">
                            <input class="evaluation-content__grade-input grade-4" type="radio" name="evaluation-grade-service" value=4 id="evaluation-grade-service-4" onchange="this.form.submit()" @if(@$_POST["evaluation-grade-service"] === '4') checked @endif>
                            @if(@$_POST["evaluation-grade-service"] >= 4)
                            <img class="evaluation-content__grade-icon--on grade-on-4" src="{{ asset('storage/icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon--off grade-off-4" src="{{ asset('storage/icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>

                        <label class="evaluation-content__grade-label" for="evaluation-grade-service-5">
                            <input class="evaluation-content__grade-input grade-5" type="radio" name="evaluation-grade-service" value=5 id="evaluation-grade-service-5" onchange="this.form.submit()" @if(@$_POST["evaluation-grade-service"] === '5') checked @endif>
                            @if(@$_POST["evaluation-grade-service"] >= 5)
                            <img class="evaluation-content__grade-icon--on grade-on-5" src="{{ asset('storage/icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon--off grade-off-5" src="{{ asset('storage/icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>
                    </td>
                </tr>

                <tr class="evaluation-content__row">
                    <th class="evaluation-content__grade-title">雰囲気</th>
                    <td class="evaluation-content__table-grade">
                        <label class="evaluation-content__grade-label" for="evaluation-grade-atmosphere-1">
                            <input class="evaluation-content__grade-input grade-1" type="radio" name="evaluation-grade-atmosphere" value=1 id="evaluation-grade-atmosphere-1" onchange="this.form.submit()" @if(@$_POST["evaluation-grade-atmosphere"] === '1') checked @endif>
                            @if(@$_POST["evaluation-grade-atmosphere"] >= 1)
                            <img class="evaluation-content__grade-icon--on grade-on-1" src="{{ asset('storage/icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon--off grade-off-1" src="{{ asset('storage/icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>

                        <label class="evaluation-content__grade-label" for="evaluation-grade-atmosphere-2">
                            <input class="evaluation-content__grade-input grade-2" type="radio" name="evaluation-grade-atmosphere" value=2 id="evaluation-grade-atmosphere-2" onchange="this.form.submit()" @if(@$_POST["evaluation-grade-atmosphere"] === '2') checked @endif>
                            @if(@$_POST["evaluation-grade-atmosphere"] >= 2)
                            <img class="evaluation-content__grade-icon--on grade-on-2" src="{{ asset('storage/icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon--off grade-off-2" src="{{ asset('storage/icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>

                        <label class="evaluation-content__grade-label" for="evaluation-grade-atmosphere-3">
                            <input class="evaluation-content__grade-input grade-3" type="radio" name="evaluation-grade-atmosphere" value=3 id="evaluation-grade-atmosphere-3" onchange="this.form.submit()" @if(@$_POST["evaluation-grade-atmosphere"] === '3') checked @endif>
                            @if(@$_POST["evaluation-grade-atmosphere"] >= 3)
                            <img class="evaluation-content__grade-icon--on grade-on-3" src="{{ asset('storage/icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon--off grade-off-3" src="{{ asset('storage/icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>

                        <label class="evaluation-content__grade-label" for="evaluation-grade-atmosphere-4">
                            <input class="evaluation-content__grade-input grade-4" type="radio" name="evaluation-grade-atmosphere" value=4 id="evaluation-grade-atmosphere-4" onchange="this.form.submit()" @if(@$_POST["evaluation-grade-atmosphere"] === '4') checked @endif>
                            @if(@$_POST["evaluation-grade-atmosphere"] >= 4)
                            <img class="evaluation-content__grade-icon--on grade-on-4" src="{{ asset('storage/icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon--off grade-off-4" src="{{ asset('storage/icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>

                        <label class="evaluation-content__grade-label" for="evaluation-grade-atmosphere-5">
                            <input class="evaluation-content__grade-input grade-5" type="radio" name="evaluation-grade-atmosphere" value=5 id="evaluation-grade-atmosphere-5" onchange="this.form.submit()" @if(@$_POST["evaluation-grade-atmosphere"] === '5') checked @endif>
                            @if(@$_POST["evaluation-grade-atmosphere"] >= 5)
                            <img class="evaluation-content__grade-icon--on grade-on-5" src="{{ asset('storage/icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon--off grade-off-5" src="{{ asset('storage/icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>
                    </td>
                </tr>
            </table>
        </form>
        <form class="evaluation-content__result" method="post" action="/reservation/evaluation/add">
            @csrf
            <div class="evaluation-content__comment">
                <textarea class="evaluation-content__comment-input" name="comment-result" rows="10" placeholder="コメント入力欄"></textarea>
            </div>
            <input type="hidden" name="grade-result-general" value="{{ @$_POST["evaluation-grade-general"] }}">
            <input type="hidden" name="grade-result-meal" value="{{ @$_POST["evaluation-grade-meal"] }}">
            <input type="hidden" name="grade-result-service" value="{{ @$_POST["evaluation-grade-service"] }}">
            <input type="hidden" name="grade-result-atmosphere" value="{{ @$_POST["evaluation-grade-atmosphere"] }}">
            <div class="evaluation-content__button">
                <input type="hidden" name="shop-id" value="{{ $shop->id }}">
                <input type="hidden" name="reservation-id" value="{{ $reservation->id}}">
                <button class="evaluation-content__button-submit" type="submit">送信</button>
            </div>
        </form>
    </div>
</div>
@endsection