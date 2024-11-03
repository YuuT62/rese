@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/evaluation.css') }}">
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="detail-wrapper">
    <div class="detail-content">
        <h1 class="detail-content__shop-name">
            <a class="detail-content__back" href="/"><</a>
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

    <div class="evaluation-content">
        <h2 class="evaluation-content__header">
            評価入力欄
        </h2>
        <form class="evaluation-content__input" method="post" action="/reservation/evaluation">
            @csrf
            <input type="hidden" name="reservation_id" value="{{ $reservation->id }} ">
            <table class="evaluation-content__table">
                <tr class="evaluation-content__row">
                    <th class="evaluation-content__grade-title">総合</th>
                    <td class="evaluation-content__table-grade">
                        <label class="evaluation-content__grade-label" for="evaluation_grade_general_1">
                            <input class="evaluation-content__grade-input grade-1" type="radio" name="evaluation_grade_general" value=1 id="evaluation_grade_general_1" onchange="this.form.submit()" @if(@$_POST["evaluation_grade_general"] === '1') checked @endif>
                            @if(@$_POST["evaluation_grade_general"] >= 1)
                            <img class="evaluation-content__grade-icon--on grade-on-1" src="{{ asset('storage/icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon--off grade-off-1" src="{{ asset('storage/icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>

                        <label class="evaluation-content__grade-label" for="evaluation_grade_general_2">
                            <input class="evaluation-content__grade-input grade-2" type="radio" name="evaluation_grade_general" value=2 id="evaluation_grade_general_2" onchange="this.form.submit()" @if(@$_POST["evaluation_grade_general"] === '2') checked @endif>
                            @if(@$_POST["evaluation_grade_general"] >= 2)
                            <img class="evaluation-content__grade-icon--on grade-on-2" src="{{ asset('storage/icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon--off grade-off-2" src="{{ asset('storage/icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>

                        <label class="evaluation-content__grade-label" for="evaluation_grade_general_3">
                            <input class="evaluation-content__grade-input grade-3" type="radio" name="evaluation_grade_general" value=3 id="evaluation_grade_general_3" onchange="this.form.submit()" @if(@$_POST["evaluation_grade_general"] === '3') checked @endif>
                            @if(@$_POST["evaluation_grade_general"] >= 3)
                            <img class="evaluation-content__grade-icon--on grade-on-3" src="{{ asset('storage/icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon--off grade-off-3" src="{{ asset('storage/icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>

                        <label class="evaluation-content__grade-label" for="evaluation_grade_general_4">
                            <input class="evaluation-content__grade-input grade-4" type="radio" name="evaluation_grade_general" value=4 id="evaluation_grade_general_4" onchange="this.form.submit()" @if(@$_POST["evaluation_grade_general"] === '4') checked @endif>
                            @if(@$_POST["evaluation_grade_general"] >= 4)
                            <img class="evaluation-content__grade-icon--on grade-on-4" src="{{ asset('storage/icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon--off grade-off-4" src="{{ asset('storage/icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>

                        <label class="evaluation-content__grade-label" for="evaluation_grade_general_5">
                            <input class="evaluation-content__grade-input grade-5" type="radio" name="evaluation_grade_general" value=5 id="evaluation_grade_general_5" onchange="this.form.submit()" @if(@$_POST["evaluation_grade_general"] === '5') checked @endif>
                            @if(@$_POST["evaluation_grade_general"] >= 5)
                            <img class="evaluation-content__grade-icon--on grade-on-5" src="{{ asset('storage/icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon--off grade-off-5" src="{{ asset('storage/icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>
                    </td>
                </tr>

                <tr class="evaluation-content__row">
                    <th class="evaluation-content__grade-title">食事</th>
                    <td class="evaluation-content__table-grade">
                        <label class="evaluation-content__grade-label" for="evaluation_grade_meal_1">
                            <input class="evaluation-content__grade-input grade-1" type="radio" name="evaluation_grade_meal" value=1 id="evaluation_grade_meal_1" onchange="this.form.submit()" @if(@$_POST["evaluation_grade_meal"] === '1') checked @endif>
                            @if(@$_POST["evaluation_grade_meal"] >= 1)
                            <img class="evaluation-content__grade-icon--on grade-on-1" src="{{ asset('storage/icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon--off grade-off-1" src="{{ asset('storage/icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>

                        <label class="evaluation-content__grade-label" for="evaluation_grade_meal_2">
                            <input class="evaluation-content__grade-input grade-2" type="radio" name="evaluation_grade_meal" value=2 id="evaluation_grade_meal_2" onchange="this.form.submit()" @if(@$_POST["evaluation_grade_meal"] === '2') checked @endif>
                            @if(@$_POST["evaluation_grade_meal"] >= 2)
                            <img class="evaluation-content__grade-icon--on grade-on-2" src="{{ asset('storage/icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon--off grade-off-2" src="{{ asset('storage/icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>

                        <label class="evaluation-content__grade-label" for="evaluation_grade_meal_3">
                            <input class="evaluation-content__grade-input grade-3" type="radio" name="evaluation_grade_meal" value=3 id="evaluation_grade_meal_3" onchange="this.form.submit()" @if(@$_POST["evaluation_grade_meal"] === '3') checked @endif>
                            @if(@$_POST["evaluation_grade_meal"] >= 3)
                            <img class="evaluation-content__grade-icon--on grade-on-3" src="{{ asset('storage/icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon--off grade-off-3" src="{{ asset('storage/icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>

                        <label class="evaluation-content__grade-label" for="evaluation_grade_meal_4">
                            <input class="evaluation-content__grade-input grade-4" type="radio" name="evaluation_grade_meal" value=4 id="evaluation_grade_meal_4" onchange="this.form.submit()" @if(@$_POST["evaluation_grade_meal"] === '4') checked @endif>
                            @if(@$_POST["evaluation_grade_meal"] >= 4)
                            <img class="evaluation-content__grade-icon--on grade-on-4" src="{{ asset('storage/icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon--off grade-off-4" src="{{ asset('storage/icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>

                        <label class="evaluation-content__grade-label" for="evaluation_grade_meal_5">
                            <input class="evaluation-content__grade-input grade-5" type="radio" name="evaluation_grade_meal" value=5 id="evaluation_grade_meal_5" onchange="this.form.submit()" @if(@$_POST["evaluation_grade_meal"] === '5') checked @endif>
                            @if(@$_POST["evaluation_grade_meal"] >= 5)
                            <img class="evaluation-content__grade-icon--on grade-on-5" src="{{ asset('storage/icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon--off grade-off-5" src="{{ asset('storage/icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>
                    </td>
                </tr>

                <tr class="evaluation-content__row">
                    <th class="evaluation-content__grade-title">サービス</th>
                    <td class="evaluation-content__table-grade">
                        <label class="evaluation-content__grade-label" for="evaluation_grade_service_1">
                            <input class="evaluation-content__grade-input grade-1" type="radio" name="evaluation_grade_service" value=1 id="evaluation_grade_service_1" onchange="this.form.submit()" @if(@$_POST["evaluation_grade_service"] === '1') checked @endif>
                            @if(@$_POST["evaluation_grade_service"] >= 1)
                            <img class="evaluation-content__grade-icon--on grade-on-1" src="{{ asset('storage/icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon--off grade-off-1" src="{{ asset('storage/icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>

                        <label class="evaluation-content__grade-label" for="evaluation_grade_service_2">
                            <input class="evaluation-content__grade-input grade-2" type="radio" name="evaluation_grade_service" value=2 id="evaluation_grade_service_2" onchange="this.form.submit()" @if(@$_POST["evaluation_grade_service"] === '2') checked @endif>
                            @if(@$_POST["evaluation_grade_service"] >= 2)
                            <img class="evaluation-content__grade-icon--on grade-on-2" src="{{ asset('storage/icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon--off grade-off-2" src="{{ asset('storage/icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>

                        <label class="evaluation-content__grade-label" for="evaluation_grade_service_3">
                            <input class="evaluation-content__grade-input grade-3" type="radio" name="evaluation_grade_service" value=3 id="evaluation_grade_service_3" onchange="this.form.submit()" @if(@$_POST["evaluation_grade_service"] === '3') checked @endif>
                            @if(@$_POST["evaluation_grade_service"] >= 3)
                            <img class="evaluation-content__grade-icon--on grade-on-3" src="{{ asset('storage/icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon--off grade-off-3" src="{{ asset('storage/icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>

                        <label class="evaluation-content__grade-label" for="evaluation_grade_service_4">
                            <input class="evaluation-content__grade-input grade-4" type="radio" name="evaluation_grade_service" value=4 id="evaluation_grade_service_4" onchange="this.form.submit()" @if(@$_POST["evaluation_grade_service"] === '4') checked @endif>
                            @if(@$_POST["evaluation_grade_service"] >= 4)
                            <img class="evaluation-content__grade-icon--on grade-on-4" src="{{ asset('storage/icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon--off grade-off-4" src="{{ asset('storage/icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>

                        <label class="evaluation-content__grade-label" for="evaluation_grade_service_5">
                            <input class="evaluation-content__grade-input grade-5" type="radio" name="evaluation_grade_service" value=5 id="evaluation_grade_service_5" onchange="this.form.submit()" @if(@$_POST["evaluation_grade_service"] === '5') checked @endif>
                            @if(@$_POST["evaluation_grade_service"] >= 5)
                            <img class="evaluation-content__grade-icon--on grade-on-5" src="{{ asset('storage/icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon--off grade-off-5" src="{{ asset('storage/icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>
                    </td>
                </tr>

                <tr class="evaluation-content__row">
                    <th class="evaluation-content__grade-title">雰囲気</th>
                    <td class="evaluation-content__table-grade">
                        <label class="evaluation-content__grade-label" for="evaluation_grade_atmosphere_1">
                            <input class="evaluation-content__grade-input grade-1" type="radio" name="evaluation_grade_atmosphere" value=1 id="evaluation_grade_atmosphere_1" onchange="this.form.submit()" @if(@$_POST["evaluation_grade_atmosphere"] === '1') checked @endif>
                            @if(@$_POST["evaluation_grade_atmosphere"] >= 1)
                            <img class="evaluation-content__grade-icon--on grade-on-1" src="{{ asset('storage/icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon--off grade-off-1" src="{{ asset('storage/icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>

                        <label class="evaluation-content__grade-label" for="evaluation_grade_atmosphere_2">
                            <input class="evaluation-content__grade-input grade-2" type="radio" name="evaluation_grade_atmosphere" value=2 id="evaluation_grade_atmosphere_2" onchange="this.form.submit()" @if(@$_POST["evaluation_grade_atmosphere"] === '2') checked @endif>
                            @if(@$_POST["evaluation_grade_atmosphere"] >= 2)
                            <img class="evaluation-content__grade-icon--on grade-on-2" src="{{ asset('storage/icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon--off grade-off-2" src="{{ asset('storage/icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>

                        <label class="evaluation-content__grade-label" for="evaluation_grade_atmosphere_3">
                            <input class="evaluation-content__grade-input grade-3" type="radio" name="evaluation_grade_atmosphere" value=3 id="evaluation_grade_atmosphere_3" onchange="this.form.submit()" @if(@$_POST["evaluation_grade_atmosphere"] === '3') checked @endif>
                            @if(@$_POST["evaluation_grade_atmosphere"] >= 3)
                            <img class="evaluation-content__grade-icon--on grade-on-3" src="{{ asset('storage/icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon--off grade-off-3" src="{{ asset('storage/icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>

                        <label class="evaluation-content__grade-label" for="evaluation_grade_atmosphere_4">
                            <input class="evaluation-content__grade-input grade-4" type="radio" name="evaluation_grade_atmosphere" value=4 id="evaluation_grade_atmosphere_4" onchange="this.form.submit()" @if(@$_POST["evaluation_grade_atmosphere"] === '4') checked @endif>
                            @if(@$_POST["evaluation_grade_atmosphere"] >= 4)
                            <img class="evaluation-content__grade-icon--on grade-on-4" src="{{ asset('storage/icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon--off grade-off-4" src="{{ asset('storage/icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>

                        <label class="evaluation-content__grade-label" for="evaluation_grade_atmosphere_5">
                            <input class="evaluation-content__grade-input grade-5" type="radio" name="evaluation_grade_atmosphere" value=5 id="evaluation_grade_atmosphere_5" onchange="this.form.submit()" @if(@$_POST["evaluation_grade_atmosphere"] === '5') checked @endif>
                            @if(@$_POST["evaluation_grade_atmosphere"] >= 5)
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
                <textarea class="evaluation-content__comment-input" name="comment_result" rows="10" placeholder="コメント入力欄"></textarea>
            </div>
            <input type="hidden" name="grade_result_general" value="{{ @$_POST["evaluation_grade_general"] }}">
            <input type="hidden" name="grade_result_meal" value="{{ @$_POST["evaluation_grade_meal"] }}">
            <input type="hidden" name="grade_result_service" value="{{ @$_POST["evaluation_grade_service"] }}">
            <input type="hidden" name="grade_result_atmosphere" value="{{ @$_POST["evaluation_grade_atmosphere"] }}">
            <div class="evaluation-content__button">
                <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                <input type="hidden" name="reservation_id" value="{{ $reservation->id}}">
                <button class="evaluation-content__button-submit" type="submit">送信</button>
            </div>
        </form>
    </div>
</div>
@endsection