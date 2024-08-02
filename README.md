<<<<<<< HEAD
# kotobum-backend
=======
Laravel sailというのを使っています。
https://readouble.com/laravel/9.x/ja/sail.html

docker + laravelをいい感じに使えるローカル環境の開発パッケージ的なものです。

sailに入っている都合でたくさんのdockerコンテナが入っていますが使っているのは以下２つだけです。
laravel, mysql

あとのやつは消してもらっても問題ないと思います。

# 開発環境の作成
以下の手順で作成できるはずです。

### .envファイルの作成
.env.exampleファイルをコピーしてローカル用の.envファイルを作成します。

以下の値が設定できていればOKなはずです。

```
APP_NAME=Laravel
APP_ENV=develop
APP_KEY=base64:OPWijUadTytLCDwDemL5tdRm6lZUY4y6usavRS6BMjo=
APP_DEBUG=true
APP_URL=http://0.0.0.0

LOG_CHANNEL=daily
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=example_app
DB_USERNAME=root
DB_PASSWORD=password

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
# QUEUE_CONNECTION=database
QUEUE_DRIVER=database

```

#### ローカル環境の立ち上げ
./vendor/bin/sail up -d

#### composerインストール（ライブラリのインストール）
./vendor/bin/sail composer install

#### DBのマイグレーション
./vendor/bin/sail artisan migrate

#### jobを動かす
動かなくてもとりあえず問題ないです。バッチとJob系を開発するときだけ動かせば問題ありません。

./vendor/bin/sail artisan queue:work

または

./vendor/bin/sail artisan queue:listen

参考: https://qiita.com/_hiro_dev/items/eef6778179e692507c84


# テストについて
余裕がなくテストコードをまったく作っていません。すいません。。

できたら作って欲しいです。ぜったいバグ残ってるはずです。


# ここにコード以外の説明も書いちゃいます。すいません。

# APIドキュメント
futarinoのAPIの一覧です
フロントの人と共有するために使っています。
https://docs.google.com/spreadsheets/d/1Mu9vsNh0iKvkQRG6mndvEu4TxUev_JotVtnYSOkoVqE/edit#gid=0


# 全体的なインフラ
開発環境、本番環境があります。

開発環境：mixhost（レンタルサーバ）藤田の個人的なサーバなので、いずれ他のサーバ使ってもらうことになると思います。

本番環境：xサーバーのvps。web,app,dbすべて１台の上に乗っています。

https://docs.google.com/presentation/d/1evnDut_K8Fain6zUYbg1HqLg5iGswW-7AaVs0Hb54QI/edit?usp=sharing

# デプロイについて
github actionsでデプロイしています。

mainブランチを開発、本番環境の両方にデプロイにいっています。

`.github/workflows/main.yml`


具体的な動作はこちらを確認してください。

`scripts/deploy.sh`

## 本番について
jobのファイルはデプロイしたタイミングで再起動しないといけません。

ちょと事情があり、再起動についてはストップをphp artisan queue:restartでやって、
スタートは、本番のサーバで動いているプロセス監視ツールのsupervisorというのでやっています。


参考: https://skrum.co.jp/blog/job-changes-not-reflected/
>>>>>>> 539675b (first commit)
