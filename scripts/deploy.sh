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
# if [ "$1" = "main" ]
# then
#     cd /var/www/vhosts/official_backend/official_0319
# fi

# 開発環境(releaseブランチ)
if [ "$1" = "release" ]
then
    cd /var/www/vhosts/kotobum-back/kotobum-backend/
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

# worker restart
# 本番ではsupervisorが再起動をかける
php artisan queue:restart
result=$?
if [ $result -ne 0 ]; then
    exit $result
fi

# Exit maintenance mode
php artisan up
result=$?
if [ $result -ne 0 ]; then
    exit $result
fi

echo "Deployment finished!"
