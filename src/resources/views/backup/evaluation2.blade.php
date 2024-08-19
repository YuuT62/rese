@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/evaluation.css') }}">
@endsection

@section('content')
<div class="detail-wrapper">
    <div class="detail-content">
        <h2 class="detail-content__shop-name">
            <a class="detail-content__back" href="#" onclick="history.back()"><</a>
            {{ $shop->shop_name }}
        </h2>
        <div class="detail-content__shop-img">
            <img src="{{ asset('shop-img/'.$shop->img) }}" alt="shop-img">
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
                        <input class="evaluation-content__grade-input  grade-1" type="radio" name="evaluation-grade-total" value=1 id="evaluation-grade-total-1">
                        <div class="evaluation-content__grade-wrapper grade-on-1">
                            <div class="evaluation-content__grade-flex">
                                <label class="evaluation-content__grade-label--on" for="evaluation-grade-total-1">
                                <img class="evaluation-content__grade-icon" src="{{ asset('icon/grade_on_icon.png') }}" alt="grade_on_icon">
                                </label>
                            </div>
                        </div>
                        <label class="evaluation-content__grade-label--off" for="evaluation-grade-total-1">
                            <img class="evaluation-content__grade-icon" src="{{ asset('icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>


                        <input class="evaluation-content__grade-input  grade-2" type="radio" name="evaluation-grade-total" value=2 id="evaluation-grade-total-2">
                        <div class="evaluation-content__grade-wrapper grade-on-2">
                            <div class="evaluation-content__grade-flex">
                                <label class="evaluation-content__grade-label--on" for="evaluation-grade-total-1">
                                <img class="evaluation-content__grade-icon" src="{{ asset('icon/grade_on_icon.png') }}" alt="grade_on_icon">
                                </label>
                                <label class="evaluation-content__grade-label--on" for="evaluation-grade-total-2">
                                <img class="evaluation-content__grade-icon" src="{{ asset('icon/grade_on_icon.png') }}" alt="grade_on_icon">
                                </label>
                            </div>
                        </div>
                        <label class="evaluation-content__grade-label--off" for="evaluation-grade-total-2">
                            <img class="evaluation-content__grade-icon" src="{{ asset('icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>

                        <input class="evaluation-content__grade-input grade-3" type="radio" name="evaluation-grade-total" value=3 id="evaluation-grade-total-3">
                        <div class="evaluation-content__grade-wrapper grade-on-3">
                            <div class="evaluation-content__grade-flex">
                                <label class="evaluation-content__grade-label--on" for="evaluation-grade-total-1">
                                    <img class="evaluation-content__grade-icon" src="{{ asset('icon/grade_on_icon.png') }}" alt="grade_on_icon">
                                </label>
                                <label class="evaluation-content__grade-label--on" for="evaluation-grade-total-2">
                                    <img class="evaluation-content__grade-icon" src="{{ asset('icon/grade_on_icon.png') }}" alt="grade_on_icon">
                                </label>
                                <label class="evaluation-content__grade-label--on" for="evaluation-grade-total-3">
                                    <img class="evaluation-content__grade-icon" src="{{ asset('icon/grade_on_icon.png') }}" alt="grade_on_icon">
                                </label>
                            </div>
                        </div>
                        <label class="evaluation-content__grade-label" for="evaluation-grade-total-3">
                            <img class="evaluation-content__grade-icon" src="{{ asset('icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>

                        <input class="evaluation-content__grade-input grade-4" type="radio" name="evaluation-grade-total" value=4 id="evaluation-grade-total-4">
                        <div class="evaluation-content__grade-wrapper grade-on-4">
                            <div class="evaluation-content__grade-flex">
                                <label class="evaluation-content__grade-label--on" for="evaluation-grade-total-1">
                                    <img class="evaluation-content__grade-icon" src="{{ asset('icon/grade_on_icon.png') }}" alt="grade_on_icon">
                                </label>
                                <label class="evaluation-content__grade-label--on" for="evaluation-grade-total-2">
                                    <img class="evaluation-content__grade-icon" src="{{ asset('icon/grade_on_icon.png') }}" alt="grade_on_icon">
                                </label>
                                <label class="evaluation-content__grade-label--on" for="evaluation-grade-total-3">
                                    <img class="evaluation-content__grade-icon" src="{{ asset('icon/grade_on_icon.png') }}" alt="grade_on_icon">
                                </label>
                                <label class="evaluation-content__grade-label--on" for="evaluation-grade-total-4">
                                    <img class="evaluation-content__grade-icon" src="{{ asset('icon/grade_on_icon.png') }}" alt="grade_on_icon">
                                </label>
                            </div>
                        </div>
                        <label class="evaluation-content__grade-label" for="evaluation-grade-total-4">
                            <img class="evaluation-content__grade-icon" src="{{ asset('icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>

                        <input class="evaluation-content__grade-input grade-5" type="radio" name="evaluation-grade-total" value=5 id="evaluation-grade-total-5">
                        <div class="evaluation-content__grade-wrapper grade-on-5">
                            <div class="evaluation-content__grade-flex">
                                <label class="evaluation-content__grade-label--on" for="evaluation-grade-total-1">
                                    <img class="evaluation-content__grade-icon" src="{{ asset('icon/grade_on_icon.png') }}" alt="grade_on_icon">
                                </label>
                                <label class="evaluation-content__grade-label--on" for="evaluation-grade-total-2">
                                    <img class="evaluation-content__grade-icon" src="{{ asset('icon/grade_on_icon.png') }}" alt="grade_on_icon">
                                </label>
                                <label class="evaluation-content__grade-label--on" for="evaluation-grade-total-3">
                                    <img class="evaluation-content__grade-icon" src="{{ asset('icon/grade_on_icon.png') }}" alt="grade_on_icon">
                                </label>
                                <label class="evaluation-content__grade-label--on" for="evaluation-grade-total-4">
                                    <img class="evaluation-content__grade-icon" src="{{ asset('icon/grade_on_icon.png') }}" alt="grade_on_icon">
                                </label>
                                <label class="evaluation-content__grade-label--on" for="evaluation-grade-total-5">
                                    <img class="evaluation-content__grade-icon" src="{{ asset('icon/grade_on_icon.png') }}" alt="grade_on_icon">
                                </label>
                            </div>
                        </div>
                        <label class="evaluation-content__grade-label" for="evaluation-grade-total-5">
                            <img class="evaluation-content__grade-icon" src="{{ asset('icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>
                    </td>
                </tr>






                <tr class="evaluation-content__row">
                    <th class="evaluation-content__grade-title">食事</th>
                    <td class="evaluation-content__table-grade">
                        <label class="evaluation-content__grade-label" for="evaluation-grade-meal-1">
                            <input class="evaluation-content__grade-input grade-1" type="radio" name="evaluation-grade-meal" value=1 id="evaluation-grade-meal-1" onchange="this.form.submit()" @if(@$_POST["evaluation-grade-meal"] === '1') checked @endif>
                            @if(@$_POST["evaluation-grade-meal"] >= 1)
                            <img class="evaluation-content__grade-icon grade-on-1" src="{{ asset('icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon grade-off-1" src="{{ asset('icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>

                        <label class="evaluation-content__grade-label" for="evaluation-grade-meal-2">
                            <input class="evaluation-content__grade-input grade-2" type="radio" name="evaluation-grade-meal" value=2 id="evaluation-grade-meal-2" onchange="this.form.submit()" @if(@$_POST["evaluation-grade-meal"] === '2') checked @endif>
                            @if(@$_POST["evaluation-grade-meal"] >= 2)
                            <img class="evaluation-content__grade-icon grade-on-2" src="{{ asset('icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon grade-off-2" src="{{ asset('icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>

                        <label class="evaluation-content__grade-label" for="evaluation-grade-meal-3">
                            <input class="evaluation-content__grade-input grade-3" type="radio" name="evaluation-grade-meal" value=3 id="evaluation-grade-meal-3" onchange="this.form.submit()" @if(@$_POST["evaluation-grade-meal"] === '3') checked @endif>
                            @if(@$_POST["evaluation-grade-meal"] >= 3)
                            <img class="evaluation-content__grade-icon grade-on-3" src="{{ asset('icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon grade-off-3" src="{{ asset('icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>

                        <label class="evaluation-content__grade-label" for="evaluation-grade-meal-4">
                            <input class="evaluation-content__grade-input grade-4" type="radio" name="evaluation-grade-meal" value=4 id="evaluation-grade-meal-4" onchange="this.form.submit()" @if(@$_POST["evaluation-grade-meal"] === '4') checked @endif>
                            @if(@$_POST["evaluation-grade-meal"] >= 4)
                            <img class="evaluation-content__grade-icon grade-on-4" src="{{ asset('icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon grade-off-4" src="{{ asset('icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>

                        <label class="evaluation-content__grade-label" for="evaluation-grade-meal-5">
                            <input class="evaluation-content__grade-input grade-5" type="radio" name="evaluation-grade-meal" value=5 id="evaluation-grade-meal-5" onchange="this.form.submit()" @if(@$_POST["evaluation-grade-meal"] === '5') checked @endif>
                            @if(@$_POST["evaluation-grade-meal"] >= 5)
                            <img class="evaluation-content__grade-icon grade-on-5" src="{{ asset('icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon grade-off-5" src="{{ asset('icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>
                    </td>
                </tr>








                <tr class="evaluation-content__row">
                    <th class="evaluation-content__grade-title">サービス</th>
                    <td class="evaluation-content__table-grade">
                        <label class="evaluation-content__grade-label" for="evaluation-grade-service-1">
                            <input class="evaluation-content__grade-input grade-1" type="radio" name="evaluation-grade-service" value=1 id="evaluation-grade-service-1" onchange="this.form.submit()" @if(@$_POST["evaluation-grade-service"] === '1') checked @endif>
                            @if(@$_POST["evaluation-grade-service"] >= 1)
                            <img class="evaluation-content__grade-icon grade-on-1" src="{{ asset('icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon grade-off-1" src="{{ asset('icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>

                        <label class="evaluation-content__grade-label" for="evaluation-grade-service-2">
                            <input class="evaluation-content__grade-input grade-2" type="radio" name="evaluation-grade-service" value=2 id="evaluation-grade-service-2" onchange="this.form.submit()" @if(@$_POST["evaluation-grade-service"] === '2') checked @endif>
                            @if(@$_POST["evaluation-grade-service"] >= 2)
                            <img class="evaluation-content__grade-icon grade-on-2" src="{{ asset('icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon grade-off-2" src="{{ asset('icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>

                        <label class="evaluation-content__grade-label" for="evaluation-grade-service-3">
                            <input class="evaluation-content__grade-input grade-3" type="radio" name="evaluation-grade-service" value=3 id="evaluation-grade-service-3" onchange="this.form.submit()" @if(@$_POST["evaluation-grade-service"] === '3') checked @endif>
                            @if(@$_POST["evaluation-grade-service"] >= 3)
                            <img class="evaluation-content__grade-icon grade-on-3" src="{{ asset('icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon grade-off-3" src="{{ asset('icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>

                        <label class="evaluation-content__grade-label" for="evaluation-grade-service-4">
                            <input class="evaluation-content__grade-input grade-4" type="radio" name="evaluation-grade-service" value=4 id="evaluation-grade-service-4" onchange="this.form.submit()" @if(@$_POST["evaluation-grade-service"] === '4') checked @endif>
                            @if(@$_POST["evaluation-grade-service"] >= 4)
                            <img class="evaluation-content__grade-icon grade-on-4" src="{{ asset('icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon grade-off-4" src="{{ asset('icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>

                        <label class="evaluation-content__grade-label" for="evaluation-grade-service-5">
                            <input class="evaluation-content__grade-input grade-5" type="radio" name="evaluation-grade-service" value=5 id="evaluation-grade-service-5" onchange="this.form.submit()" @if(@$_POST["evaluation-grade-service"] === '5') checked @endif>
                            @if(@$_POST["evaluation-grade-service"] >= 5)
                            <img class="evaluation-content__grade-icon grade-on-5" src="{{ asset('icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon grade-off-5" src="{{ asset('icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>
                    </td>
                </tr>







                <tr class="evaluation-content__row">
                    <th class="evaluation-content__grade-title">雰囲気</th>
                    <td class="evaluation-content__table-grade">
                        <label class="evaluation-content__grade-label" for="evaluation-grade-atmosphere-1">
                            <input class="evaluation-content__grade-input grade-1" type="radio" name="evaluation-grade-atmosphere" value=1 id="evaluation-grade-atmosphere-1" onchange="this.form.submit()" @if(@$_POST["evaluation-grade-atmosphere"] === '1') checked @endif>
                            @if(@$_POST["evaluation-grade-atmosphere"] >= 1)
                            <img class="evaluation-content__grade-icon grade-on-1" src="{{ asset('icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon grade-off-1" src="{{ asset('icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>

                        <label class="evaluation-content__grade-label" for="evaluation-grade-atmosphere-2">
                            <input class="evaluation-content__grade-input grade-2" type="radio" name="evaluation-grade-atmosphere" value=2 id="evaluation-grade-atmosphere-2" onchange="this.form.submit()" @if(@$_POST["evaluation-grade-atmosphere"] === '2') checked @endif>
                            @if(@$_POST["evaluation-grade-atmosphere"] >= 2)
                            <img class="evaluation-content__grade-icon grade-on-2" src="{{ asset('icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon grade-off-2" src="{{ asset('icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>

                        <label class="evaluation-content__grade-label" for="evaluation-grade-atmosphere-3">
                            <input class="evaluation-content__grade-input grade-3" type="radio" name="evaluation-grade-atmosphere" value=3 id="evaluation-grade-atmosphere-3" onchange="this.form.submit()" @if(@$_POST["evaluation-grade-atmosphere"] === '3') checked @endif>
                            @if(@$_POST["evaluation-grade-atmosphere"] >= 3)
                            <img class="evaluation-content__grade-icon grade-on-3" src="{{ asset('icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon grade-off-3" src="{{ asset('icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>

                        <label class="evaluation-content__grade-label" for="evaluation-grade-atmosphere-4">
                            <input class="evaluation-content__grade-input grade-4" type="radio" name="evaluation-grade-atmosphere" value=4 id="evaluation-grade-atmosphere-4" onchange="this.form.submit()" @if(@$_POST["evaluation-grade-atmosphere"] === '4') checked @endif>
                            @if(@$_POST["evaluation-grade-atmosphere"] >= 4)
                            <img class="evaluation-content__grade-icon grade-on-4" src="{{ asset('icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon grade-off-4" src="{{ asset('icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>

                        <label class="evaluation-content__grade-label" for="evaluation-grade-atmosphere-5">
                            <input class="evaluation-content__grade-input grade-5" type="radio" name="evaluation-grade-atmosphere" value=5 id="evaluation-grade-atmosphere-5" onchange="this.form.submit()" @if(@$_POST["evaluation-grade-atmosphere"] === '5') checked @endif>
                            @if(@$_POST["evaluation-grade-atmosphere"] >= 5)
                            <img class="evaluation-content__grade-icon grade-on-5" src="{{ asset('icon/grade_on_icon.png') }}" alt="grade_on_icon">
                            @endif
                            <img class="evaluation-content__grade-icon grade-off-5" src="{{ asset('icon/grade_off_icon.png') }}" alt="grade_off_icon">
                        </label>
                    </td>
                </tr>






            </table>














           

            <div class="evaluation-content__comment">
                <textarea class="evaluation-content__comment-input" name="evaluation-comment" rows="10" placeholder="コメント入力欄"></textarea>
            </div>
        </form>
        <form class="evaluation-content__result" method="post" action="/evaluation/add">
            @csrf
            <input type="hidden" name="grade-result" value="{{ @$_POST["evaluation-grade"] }}">
            <input type="hidden" name="comment-result" value="{{ @$_POST["evaluation-comment"] }}">
            <div class="evaluation-content__button">
                <input type="hidden" name="shop-id" value="{{ $shop->id }}">
                <button class="evaluation-content__button-submit" type="submit">送信</button>
            </div>
        </form>
    </div>
</div>



@endsection