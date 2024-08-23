##Rese(リーズ)

ある企業のグループ会社の飲食店予約サービス

![reseトップ画面](https://github.com/user-attachments/assets/05f415bb-8f30-483d-8658-fcfc8abb77eb)

##作成した目的

外部の飲食店予約サービスは手数料を取られるので自社で予約サービスを持ちたい。(実践学習ターム)

#アプリケーションのURL

※メール認証機能はAWSの「Amazon Simple Email Service」を使用しており、本稼働アクセスのリクエスト未実施（サンドボックス状態）のため、認証されたメールアドレス以外は登録できない状態です。

##機能一覧

・会員登録

・ログイン機能

・ログアウト機能

・ユーザー情報取得

・ユーザー飲食店お気に入り一覧取得

・ユーザー飲食店予約情報取得

。飲食店一覧取得

・飲食店詳細取得

・飲食店お気に入り追加

・飲食店お気に入り削除

。飲食店予約情報追加

・飲食店予約情報削除

・飲食店をエリアで検索する機能

・飲食店をジャンルで検索する機能

・飲食店を店名で検索する機能

・予約変更機能

・評価機能

・ユーザー毎の権限付与機能（管理者、店舗代表者、利用者）

・管理画面（管理者、店舗代表者のみ）

・メール認証機能

・リマインダー（予約当日にメールでお知らせ）

・QRコードによる利用者の照合機能

・決済機能（Stripeによる決済）

##使用技術

・ PHP 8.1

・ Laravel 8.83.27

・ MySQL 8.0.26

##テーブル設計

![rese-table-1](https://github.com/user-attachments/assets/8dd43af0-09cf-4dca-b724-99a5211a51e5)
![rese-table-2](https://github.com/user-attachments/assets/942c0d7f-1303-4943-9ce0-4b3cc43ae76d)
![rese-table-3](https://github.com/user-attachments/assets/d87a9717-dbf5-4db9-a907-7907e6acb04c)

##ER図

![index](https://github.com/user-attachments/assets/34d5396c-12d2-48ba-97a6-1789e7fa1614)

##環境構築

git clone git@github.com:YuuT62/rese.git

cd rese/

docker-compose up -d --build

*MySQLは、OSによって起動しない場合があるので、それぞれのPCに合わせてdocker-compose.ymlファイルを編集してください。

##Laravel環境構築

docker-compose exec php bash

composer install

.env.exampleファイルから.envファイルを作成し、環境変数を変更

　12行目)　DB_HOST=mysql

　14行目)　DB_DATABASE=laravel_db

　15行目)　DB_USERNAME=laravel_user

　16行目)　DB_PASSWORD=laravel_pass

　32行目)　MAIL_HOST=mailcatcher

  　37行目)　MAIL_FROM_ADDRESS=hoge@example.com

php artisan key:generate

php artisan migrate

php artisan db:seed

##mysql

　アクセスURL：http://localhost:8080/

##MailCatcher

　アクセスURL：http://localhost:1080/

　※テスト用のメール受取ボックス（新規ユーザー作成時の認証メールが上記URL先のメールボックスで受け取られます）

※Windowsの場合、ファイル権限エラーでアクセスできないことがあるため、以下のコマンドで回避

sudo chmod -R 777 src/*
