@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="detail-wrapper">
    <div class="detail-content">
        <h2 class="detail-content__shop-name">
            <a class="detail-content__back" href="/mypage"><</a>
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

    <div class="reservation-content">
        <h2 class="reservation-content__header">
            予約変更
        </h2>
        <form class="reservation-content__input" action="/reservation/edit" method="get">
            <input type="hidden" name="reservation-id" value="{{ $reservation->id }}">
            <div class="reservation-content__date">
                <input type="date" name="date-input" value="<?php
                    $date = explode(' ', $reservation->reservation)[0];
                    if(isset($_GET["date-input"]) && $date != @$_GET["date-input"]){
                        echo @$_GET["date-input"];
                    }
                    else{
                        echo $date;
                    }
                ?>" onchange="this.form.submit()">
                <img class="reservation-content__calender-icon" src="{{ asset('storage/icon/calendar_icon.png') }}" alt="calender_icon">
            </div>

            <div class="reservation-content__error">
                @error('date-input')
                    {{ '※'.$message }}
                @enderror
            </div>

            <div class="reservation-content__time">
                <select name="time-input" onchange="this.form.submit()">
                    <option value="" hidden>時間を選択してください</option>
                    @for($time=17; $time<=22; $time++)
                        <option value="{{ $time.':00'}}" @if(empty($_GET["time-input"]) && $time.':00:00' === explode(' ', $reservation->reservation)[1] ) selected @elseif(isset($_GET["date-input"]) && $time.':00' === @$_GET["time-input"]) selected @endif>{{$time.':00'}}</option>
                        <option value="{{ $time.':30'}}" @if(empty($_GET["time-input"]) && $time.':30:00' === explode(' ', $reservation->reservation)[1] ) selected @elseif(isset($_GET["date-input"]) && $time.':30' === @$_GET["time-input"]) selected @endif>{{$time.':30'}}</option>
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
                <select name="num-input" onchange="this.form.submit()">
                    <option value="" hidden>人数を選択してください</option>
                    @for($num=1; $num<=10; $num++)
                        <option value="{{$num}}" @if(empty($_GET["num-input"]) && $num === $reservation->num_people) selected @elseif($num === (int)@$_GET["num-input"] ) selected @endif>{{$num.'人'}}</option>
                    @endfor
                </select>
                <img class="reservation-content__select-icon" src="{{ asset('storage/icon/select_icon.png') }}" alt="select_icon">
            </div>

            <div class="reservation-content__error">
                @error('num-result')
                    {{ '※'.$message }}
                @enderror
            </div>
        </form>

        <form class="reservation-content__result" action="/reservation/update" method="post">
            @csrf
            <div class="reservation-content__table-wrapper">
                <table class="reservation-content__table">
                    <tr>
                        <th>Shop</th>
                        <td>{{ $shop->shop_name }}</td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td><?php
                        $date_result = @$_GET["date-input"];
                        ?>
                        @if(isset($date_result))
                        <input type="hidden" name="date-result" value="{{ $date_result }}">
                        {{ $date_result }}
                        @else
                        <input type="hidden" name="date-result" value="{{ explode(' ',$reservation->reservation)[0]  }}">
                        {{ explode(' ',$reservation->reservation)[0] }}
                        @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Time</th>
                        <td><?php
                        $time_result = @$_GET["time-input"];
                        ?>
                        @if(isset($time_result))
                        <input type="hidden" name="time-result" value="{{ $time_result }}">
                        {{ $time_result }}
                        @else
                        <input type="hidden" name="time-result" value="{{ substr(explode(' ',$reservation->reservation)[1], 0, -3) }}">
                        {{ substr(explode(' ',$reservation->reservation)[1], 0, -3) }}
                        @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Number</th>
                        <td><?php
                        $num_result=@$_GET["num-input"];
                        ?>
                        @if(isset($_GET["num-input"]))
                        <input type="hidden" name="num-result" value="{{ $num_result }}">
                        {{ $num_result."人" }}
                        @else
                        <input type="hidden" name="num-result" value="{{ $reservation->num_people }}">
                        {{ $reservation->num_people."人" }}
                        @endif
                        </td>
                    </tr>
                </table>
            </div>
            <div class="reservation-content__button">
                <?php
                $reservation_result=$date_result.' '.$time_result.':00';
                ?>
                @if(isset($time))
                <input type="hidden" name="reservation" value="{{ $reservation_result }}">
                @else
                <input type="hidden" name="reservation">
                @endif
                <input type="hidden" name="reservation-id" value="{{ $reservation->id }}">
                <input type="hidden" name="shop-id" value="{{ $shop->id }}">
                <button class="reservation-content__button-submit" type="submit">予約を変更する</button>
            </div>
        </form>
    </div>
</div>



@endsection