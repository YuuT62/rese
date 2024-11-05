##Rese(リーズ)

ある企業のグループ会社の飲食店予約サービス

![reseトップ画面](https://github.com/user-attachments/assets/05f415bb-8f30-483d-8658-fcfc8abb77eb)


##作成した目的

外部の飲食店予約サービスは手数料を取られるので自社で予約サービスを持ちたい。(実践学習ターム)


##アプリケーションのURL

http://ec2-13-231-44-57.ap-northeast-1.compute.amazonaws.com

※メール認証機能はAWSの「Amazon Simple Email Service」を使用しており、本稼働アクセスのリクエスト未実施（サンドボックス状態）のため、認証されたメールアドレス以外は登録できない状態です。


##機能一覧

・会員登録

・ログイン機能

・ログアウト機能

・ユーザー情報取得

・ユーザー飲食店お気に入り一覧取得

・ユーザー飲食店予約情報取得

・飲食店一覧取得

・飲食店詳細取得

・飲食店お気に入り追加

・飲食店お気に入り削除

・飲食店予約情報追加

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


##追加機能一覧（2024/11/5）

・口コミ機能

・ソート機能

・CSVファイルによる新規店舗作成機能


##使用技術

・ PHP 8.1

・ Laravel 8.83.27

・ MySQL 8.0.26


##テーブル設計

![rese-table-1](https://github.com/user-attachments/assets/1915a13d-57e2-4e32-a8a1-6d6da2ab5000)
![rese-table-2](https://github.com/user-attachments/assets/c17b6944-cffa-46cd-b041-58d356b4a6a1)
![rese-table-3](https://github.com/user-attachments/assets/5169291e-9b20-4957-ace4-0e5c3e81d9a0)

追加（2024/11/5）
![rese-table-4](https://github.com/user-attachments/assets/5dd45d0b-7f27-4885-8eaf-fcd8177b35ff)


##ER図（修正　2024/11/5）

![index](https://github.com/user-attachments/assets/46a30a28-dcb1-4edc-b964-be287243c1dc)


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

  54行目）STRIPE_KEY="（Stripeアカウントの公開可能キー）"

  55行目）STRIPE_SECRET="（Stripeアカウントのシークレットキー）"


php artisan key:generate

php artisan migrate

php artisan db:seed

php artisan storage:link

以下URLよりアイコン、店舗画像をダウンロードし、フォルダ毎に"rese/src/storage/app/public"に配置してください。

https://1drv.ms/f/s!AoUAxOjhano5nh2gKN_zh_nR485o?e=5iKvzI

ダウンロードフォルダ

・icon

・shop-image

配置先

・rese/src/storage/app/public


##mysql

　アクセスURL：http://localhost:8080/


##MailCatcher

　アクセスURL：http://localhost:1080/

　※テスト用のメール受取ボックス（新規ユーザー作成時の認証メールが上記URL先のメールボックスで受け取られます）


##リマインダー機能について
環境構築時に自動で起動させているため、追加操作はありません。（予約当日AM9:00に予約者へリマインダーメールを送信）

※Windowsの場合、ファイル権限エラーでアクセスできないことがあるため、以下のコマンドで回避

sudo chmod -R 777 src/*


##CSVファイル記載方法（追加　2024/11/5）

　記入例）
 
 　　　![csv_example](https://github.com/user-attachments/assets/d9c88dc9-3b56-4f0c-a913-8465ff27b13e)


  ※補足）
  
  ・全ての入力項目が必須です。
  
  ・nameは50文字以内で記載してください。
  
  ・overviewは400文字以内で記載してください。
  
  ・genreに指定できる値は「寿司」、「焼肉」、「イタリアン」、「居酒屋」、「ラーメン」のみです。
  
  ・areaに指定できる値は「東京都」、「大阪府」、「福岡県」のみです。
  
  ・ローカル環境の場合、「storage/shop-img」フォルダに設定する画像ファイルをアップロードしてから、urlに「http://localhost/storage/shop-img/｛ファイル名.拡張子｝」を記入してください。
  
  ・画像の拡張子は「jpg」、「png」のみ指定できます。
