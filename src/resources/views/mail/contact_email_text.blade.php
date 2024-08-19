Reseからのお知らせ

　{{ $reservation->user->name }}様

　ご予約当日となりましたためお知らせになります。

　店名　{{ $reservation->shop->shop_name }}
　ご予約時間　{{substr(explode(' ',$reservation->reservation)[1], 0, -3)}}
　ご予約人数　{{ $reservation->num_people }}人

　ご来店をお待ちしております。

Rese