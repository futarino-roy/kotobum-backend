<?php

namespace App\Auth;

use Illuminate\Auth\TokenGuard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class LineAccessTokenGuard extends TokenGuard
{
    // トークンの有効期限を保持しているユーザテーブルのフィールド
    protected string $storageExpiredKey;

    /**
     * Create a new authentication guard.
     *
     * @param  \Illuminate\Contracts\Auth\UserProvider  $provider
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function __construct(UserProvider $provider, Request $request)
    {
        $this->storageExpiredKey = 'line_access_token_expired';
        // inputKey（1つ目のapi_key）が、GET/POSTパラメータから取得するキー.
        // storageKey（2つ目のapi_key）が、DBのカラム名.
        parent::__construct($provider, $request, 'line_access_token', 'line_access_token');
    }

    public function user()
    {
        if (!is_null($this->user)) {
            return $this->user;
        }

        $user = null;

        $token = $this->getTokenForRequest();

        if (!empty($token)) {
            $user = $this->provider->retrieveByCredentials([
                $this->storageKey => $this->hash ? hash('sha256', $token) : $token,
            ]);
        }

        // トークンの有効期限チェック
        if (
            $user
            && $user->{$this->storageExpiredKey}
            && Carbon::parse($user->{$this->storageExpiredKey})->lte(Carbon::now())
        ) {
            return null;
        }

        return $this->user = $user;
    }
}
