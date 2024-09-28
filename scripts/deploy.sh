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
    cd /var/www/vhosts/kotobum-back/kotobum-backend/
fi

# 開発環境(releaseブランチ)
if [ "$1" = "release" ]
then
    cd /var/www/vhosts/kotobum-back/kotobum-backend/
fi

# username="deploy.sh ($1/`hostname -s`)"

# Enter maintenance mode or return true
# if already is in maintenance mode
(sudo php artisan down) || true

# Pull the latest version of the app
if ! (sudo git stash; sudo git fetch origin $1; sudo git checkout $1; sudo git reset --hard origin/$1)
then
    sudo php artisan up
    echo "git pull failed"
    exit 1
fi

set +e

# worker restart
# 本番ではsupervisorが再起動をかける
sudo php artisan queue:restart
result=$?
if [ $result -ne 0 ]; then
    exit $result
fi

# Exit maintenance mode
sudo php artisan up
result=$?
if [ $result -ne 0 ]; then
    exit $result
fi

echo "Deployment finished!"
