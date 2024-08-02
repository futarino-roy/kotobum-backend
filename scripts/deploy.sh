#!/bin/sh
# $1 にブランチ名を渡す

set -e

if [ "$1" = "" ]
then
    echo "Please set branch name"
    exit 2
fi
echo "Deployment started ...[branch is $1]"

# 本番環境(mainブランチ)
if [ "$1" = "main" ]
then
    cd /var/www/vhosts/official_backend/official_0319
fi

# 開発環境(releaseブランチ)
if [ "$1" = "release" ]
then
    cd /var/www/vhosts/official/backend/
fi

# username="deploy.sh ($1/`hostname -s`)"

# Enter maintenance mode or return true
# if already is in maintenance mode
(php artisan down) || true

# Pull the latest version of the app
if ! (git stash; git fetch origin $1; git checkout $1; git reset --hard origin/$1)
then
    php artisan up
    echo "git pull failed"
    exit 1
fi

set +e

# Install composer dependencies
composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader
result=$?
if [ $result -ne 0 ]; then
    exit $result
fi

# Clear the old cache
php artisan optimize:clear
result=$?
if [ $result -ne 0 ]; then
    exit $result
fi

# Recreate cache
php artisan optimize
result=$?
if [ $result -ne 0 ]; then
    exit $result
fi

# Run database migrations
php artisan migrate --force
result=$?
if [ $result -ne 0 ]; then
    exit $result
fi

# worker restart
# 本番ではsupervisorが再起動をかける
php artisan queue:restart
result=$?
if [ $result -ne 0 ]; then
    exit $result
fi

# lineの友達登録してるユーザを強制的にDBに追加(そのためのlineAPIが認証済公式垢でしか使えないのでmainマージ時のみ実行)
# 時間かかるのでデプロイ頻度が多いなら毎回やらなくてもいいかも
if [ "$1" = "main" ]
then
    echo "Start line followers putting in DB"
    php artisan command:line-followers-put-in-db
fi

# Exit maintenance mode
php artisan up
result=$?
if [ $result -ne 0 ]; then
    exit $result
fi

echo "Deployment finished!"
