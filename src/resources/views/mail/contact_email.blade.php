<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
        <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/send_email.css') }}">
</head>
<body>
    <div class="email-content">
        <div class="email-content__header">
            <h1 class="email-content__header-text">Reseからのお知らせ</h1>
        </div>
        <div class="email-content__message">
            <p>{{ $reservation->user->name }}様</p>
            <p>ご予約当日となりましたためお知らせになります。</p>
            <dl>
                <dt>店名</dt>
                <dd>{{ $reservation->shop->shop_name }}</dd>
                <dt>時間</dt>
                <dd>{{substr(explode(' ',$reservation->reservation)[1], 0, -3)}}</dd>
                <dt>人数</dt>
                <dd>{{ $reservation->num_people }}人</dd>
            </dl>
            <p>ご来店をお待ちしております。</p>
        </div>
        <div class="email-content__footer">
            <p>Rese</p>
        </div>
    </div>
</body>
</html>