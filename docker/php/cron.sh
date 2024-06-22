#!/bin/sh

# 環境変数を設定
. /root/env.sh

# 定期実行したい処理
php /var/www/artisan schedule:run >> /dev/null 2>&1