@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,1,-50..200&icon_names=star_rate" />
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="detail-wrapper">
    @if(session('messages'))
    <div class="session">
        {{session('messages')}}
    </div>
    @endif
    <div class="detail-content">
        @isset($review)
            <div class="detail-content__shop-img detail-content__shop-img--user">
                <img src="{{ asset('storage/shop-img/'.$shop->img) }}" alt="shop-img">
            </div>
            <p class="detail-content__shop-tag">
                #{{ $shop->area->area }} #{{ $shop->genre->genre}}
            </p>
            <p class="detail-content__shop-introduction">
                {{ $shop->overview }}
            </p>
            <div class="detail-content__review">
                <form class="detail-content__review-form" action="/review/list{{ $shop->id }}" method="get">
                    <button class="detail-content__review-form-submit" type="submit">全ての口コミ情報</button>
                </form>
                <div class="detail-content__review-content">
                    <div class="detail-content__review-buttons">
                        <form class="detail-content__review-button" action="/review/edit" method="get">
                            <input type="hidden" name="review_id" value="{{ $review->id }}">
                            <button class="detail-content__review-button-submit">口コミを編集</button>
                        </form>
                        <form class="detail-content__review-button" action="/review/delete" method="post">
                            @csrf
                            <input type="hidden" name="review_id" value="{{ $review->id }}">
                            <button class="detail-content__review-button-submit">口コミを削除</button>
                        </form>
                    </div>
                    @for($num = 0; $num < $review->score; $num++)
                        <span class="material-symbols-outlined star-icon" style="color:#305dff;">star_rate</span>
                    @endfor
                    @for($num = $review->score; $num < 5; $num++)
                        <span class="material-symbols-outlined star-icon" style="color:#D8D8D8;">star_rate</span>
                    @endfor
                    <p class="detail-content__review-comment">{{ $review->comment }}</p>
                </div>
            </div>
        @else
            <h1 class="detail-content__shop-name">
                <a class="detail-content__back" href="/"><</a>
                {{ $shop->shop_name }}
            </h1>
            <div class="detail-content__shop-img">
                <img src="{{ asset('storage/shop-img/'.$shop->img) }}" alt="shop-img">
            </div>
            <p class="detail-content__shop-tag">
                #{{ $shop->area->area }} #{{ $shop->genre->genre}}
            </p>
            <p class="detail-content__shop-introduction">
                {{ $shop->overview }}
            </p>
            @canany(['admin', 'representative'])
                <form class="detail-content__review-form" action="/review/list{{ $shop->id }}" method="get">
                    <button class="detail-content__review-form-submit" type="submit">全ての口コミ情報</button>
                </form>
            @endcanany
            @can('user')
                <a class="detail-content__review-send" href="/review{{$shop->id}}" style="color:#000">口コミを投稿する</a>
            @endcan
        @endisset
    </div>

    <div class="reservation-content">
        <h2 class="reservation-content__header">
            予約
        </h2>
        <form class="reservation-content__input" action="/detail/{{$shop->id}}" method="get">
            <div class="reservation-content__date">
                <input type="date" name="date_input" value="<?php
                    if(isset($_GET["date_input"])){
                        echo $_GET["date_input"];
                    }
                    else{
                        echo date('Y-m-d');
                    }
                ?>" onchange="this.form.submit()">
                <img class="reservation-content__calender-icon" src="{{ asset('storage/icon/calendar_icon.png') }}" alt="calender_icon">
            </div>

            <div class="reservation-content__error">
                @error('date_input')
                    {{ '※'.$message }}
                @enderror
            </div>

            <div class="reservation-content__time">
                <select name="time_input" onchange="this.form.submit()">
                    <option value="" hidden>時間を選択してください</option>
                    @for($time=17; $time<=22; $time++)
                        <option value="{{ $time.':00' }}" @if($time.':00' === @$_GET["time_input"] ) selected @endif>{{$time.':00'}}</option>
                        <option value="{{ $time.':30'}}"  @if($time.':30' === @$_GET["time_input"] ) selected @endif>{{$time.':30'}}</option>
                    @endfor
                </select>
                <img class="reservation-content__select-icon" src="{{ asset('storage/icon/select_icon.png') }}" alt="select_icon">
            </div>

            <div class="reservation-content__error">
                @error('reservation')
                    {{ '※'.$message }}
                @enderror
            </div>

            <div class="reservation-content__num">
                <select name="num_input" onchange="this.form.submit()">
                    <option value="" hidden>人数を選択してください</option>
                    @for($num=1; $num<=10; $num++)
                        <option value="{{$num}}" @if($num === (int)@$_GET["num_input"] ) selected @endif>{{$num.'人'}}</option>
                    @endfor
                </select>
                <img class="reservation-content__select-icon" src="{{ asset('storage/icon/select_icon.png') }}" alt="select_icon">
            </div>

            <div class="reservation-content__error">
                @error('num_result')
                    {{ '※'.$message }}
                @enderror
            </div>
        </form>
        <form class="reservation-content__result" action="/reservation/add" method="post">
            @csrf
            <input type="hidden" name="shop_id" value="$shop->id">
            <div class="reservation-content__table-wrapper">
                <table class="reservation-content__table">
                    <tr>
                        <th>Shop</th>
                        <td>{{ $shop->shop_name }}</td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td><?php
                        $date = explode(' ',@$_GET["date_input"])[0];
                        print $date;
                        ?></td>
                        <input type="hidden" name="date_result" value="{{ $date }}">
                    </tr>
                    <tr>
                        <th>Time</th>
                        <td><?php
                        $time = @$_GET["time_input"];
                        print $time;
                        ?></td>
                        <input type="hidden" name="time_result" value="{{ $time }}">
                    </tr>
                    <tr>
                        <th>Number</th>
                        <td>
                        @if(isset($_GET["num_input"]) && $_GET["num_input"] != "")
                            <?php
                            echo $_GET["num_input"].'人';
                            ?>
                            <input type="hidden" name="num_result" value="{{ $_GET["num_input"] }}">
                        </td>
                        @endif
                    </tr>
                </table>
            </div>
            <div class="reservation-content__button">
                <?php
                $reservation=$date.' '.$time.':00';
                ?>
                @if(isset($time))
                <input type="hidden" name="reservation" value="{{ $reservation }}">
                @else
                <input type="hidden" name="reservation">
                @endif
                <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                <button class="reservation-content__button-submit" type="submit">予約する</button>
            </div>
        </form>
    </div>
</div>
@endsection