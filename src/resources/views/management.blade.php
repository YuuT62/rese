@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/management.css') }}">
@endsection

@section('header')
<div class="management-header">
    @can('admin')
    <form class="management-header__button" action="/add" method="get">
        <button class="management-header__button-submit" type="submit">代表者作成</button>
    </form>
    <form class="management-header__button" action="/email" method="get">
        <button class="management-header__button-submit" type="submit">メール</button>
    </form>
    @endcan
    @can('representative')
    @cannot('admin')
    <form class="management-header__button" action="/shop/add" method="get">
        <button class="management-header__button-submit" type="submit">店舗作成</button>
    </form>
    <form class="management-header__button" action="/reservation/confirm" method="get">
        <button class="management-header__button-submit" type="submit">QR読取</button>
    </form>
    <form class="management-header__button" action="/bill" method="get">
        <button class="management-header__button-submit" type="submit">請求</button>
    </form>
    @endcannot
    @endcan
</div>
@endsection

@section('content')
<div class="management-content">
    <h2 class="management-content__header">店舗一覧</h2>
    <table class="management-content-table">
        <tr class="management-content-table__row">
            <th class="management-content-table__header">店舗名</th>
            <th class="management-content-table__header">ジャンル</th>
            <th class="management-content-table__header">エリア</th>
            @can('admin')
            <th class="management-content-table__header">代表者名</th>
            @endcan
            <th class="management-content-table__header">店舗詳細</th>
            <th class="management-content-table__header">予約情報</th>
        </tr>
        @foreach($shops as $shop)
            <tr class="management-content-table__row">
                <td class="management-content-table__desc">
                    {{ $shop->shop_name }}
                </td>
                <td class="management-content-table__desc">
                    {{ $shop->genre->genre }}
                </td>
                <td class="management-content-table__desc">
                    {{ $shop->area->area }}
                </td>
                @can('admin')
                <td class="management-content-table__desc">
                    {{ $shop->user->name }}
                </td>
                @endcan
                <td class="management-content-table__desc">
                    <form class="management-content-table__form" action="/edit/{{$shop->id}}" method="get">
                        <button class="management-content-table__form-submit" type="submit">修正</button>
                    </form>
                </td>
                <td class="management-content-table__desc">
                    <form class="management-content-table__form" action="/reservation_list/{{$shop->id}}" method="get">
                        <button class="management-content-table__form-submit" type="submit">一覧</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <div class="management-content__pagination">{{ $shops->links('vendor.pagination.default') }}</div>
</div>
@endsection