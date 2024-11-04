@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/csv_import.css') }}">
@endsection

@section('content')
<form class="csv-wrapper" action="/import/submit" method="post">
    @csrf
    <h1 class="csv__header">ファイル内容</h1>
    <div class="csv-content">
        <table class="csv-table">
            <tr class="csv-table__row">
                <th class="csv-table__header">店舗名
                </th>
                <td class="csv-table__desc">{{ $shop_data['shop_name'] }}</td>
                <input type="hidden" name="shop_name" value="{{ $shop_data['shop_name'] }}">
            </tr>
            <tr class="csv-table__row">
                <th class="csv-table__header">ジャンル
                </th>
                <td class="csv-table__desc">{{ $shop_data['genre'] }}</td>
                <input type="hidden" name="genre" value="{{ $shop_data['genre'] }}">
            </tr>
            <tr class="csv-table__row">
                <th class="csv-table__header">エリア</th>
                <td class="csv-table__desc">{{ $shop_data['area'] }}</td>
                <input type="hidden" name="area" value="{{ $shop_data['area'] }}">
            </tr>
            <tr class="csv-table__row">
                <th class="csv-table__header">店舗概要</th>
                <td class="csv-table__desc">{{ $shop_data['overview'] }}</td>
                <input type="hidden" name="overview" value="{{ $shop_data['overview'] }}">
            </tr>
            <tr class="csv-table__row">
                <th class="csv-table__header">店舗画像URL</th>
                <td class="csv-table__desc">{{ $shop_data['url'] }}</td>
                <input type="hidden" name="url" value="{{ $shop_data['url'] }}">
            </tr>
        </table>
    </div>
    <div class="csv__button">
        <button class="csv__button-submit" type="submit">新規店舗を作成</button>
    </div>
</form>
@endsection