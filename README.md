# study-app-laravel
````
# リポジトリ作成
git clone https://github.com/Yuma05/study-app-laravel.git

# ライブラリのインストール
composer install

# .env作成
cp .env.example .env

# 一時的にPATHを通す
set -x PATH ./vendor/bin $PATH

# バックグラウンドで起動
sail up -d

# APP_KEY作成
sail artisan key:generate

# キャッシュ作成
php artisan config:cache

# migrate と seed
sail artisan migrate:fresh --seed
````
# Postman collection
https://www.getpostman.com/collections/80b865c1339be4bf2b0a
