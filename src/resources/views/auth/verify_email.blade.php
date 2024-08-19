@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/verify_email.css') }}">
@endsection

@section('content')
<div class="verify-content">
    <div class="verify-content__alert">
        @if (session('status'))
            <div class="verify-content__alert-success" role="alert">
                新しい確認リンクがあなたのメールアドレスに送信されました。
            </div>
        @endif
    </div>
    <div class="verify-content__header">
        認証メールを確認してください
    </div>
    <div class="verify-content__body">
        <p>メールアドレス確認用のメールを送信しました。<br>
        メールを確認し、「認証する」をクリックしてください。<br>
        <span>(※URLの有効期限は１０分です)</span></p>
        <p>※メールが届かない場合または、URLの有効期限が切れた場合は以下のボタンをクリックしてください。</p>
        <form class="verify-content__form" method="post" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">メール再送</button>
        </form>
    </div>
</div>

@endsection