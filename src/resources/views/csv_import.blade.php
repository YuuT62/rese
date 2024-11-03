@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review_list.css') }}">
@endsection

@section('content')
<div class="csv-wrapper">
    <form class="csv-form">
        <table>
            <tr>
                <th>店舗名</th>
                <td>{{ $shop_data['shop_name'] }}</td>
                <input type="hidden" name="shop_name" value="{{ $shop_data['shop_name'] }}">
            </tr>
            <tr>
                <th>ジャンル</th>
                <td>{{ $shop_data['genre'] }}</td>
                <input type="hidden" name="genre" value="{{ $shop_data['shop_name'] }}">
            </tr>
            <tr>
                <th>エリア</th>
                <td>{{ $shop_data['area'] }}</td>
                <input type="hidden" name="area" value="{{ $shop_data['area'] }}">
            </tr>
            <tr>
                <th>店舗概要</th>
                <td>{{ $shop_data['overview'] }}</td>
                <input type="hidden" name="overview" value="{{ $shop_data['overview'] }}">
            </tr>
            <tr>
                <th>店舗画像URL</th>
                <td>{{ $shop_data['img'] }}</td>
                <input type="hidden" name="img" value="{{ $shop_data['img'] }}">
            </tr>
        </table>
    </form>

</div>
@section('content')
@endsection