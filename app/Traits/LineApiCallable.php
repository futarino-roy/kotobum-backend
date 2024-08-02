<?php

namespace App\Traits;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use App\Consts\ApiConst;
use Exception;

trait LineApiCallable
{

    /**
     * LINEのverifyを呼び出し、検証
     */
    public function lineOauthApiCall($token): bool|array
    {
        $res = Http::get(ApiConst::LINE_OAUTH_URL, [
            'access_token' => $token,
        ]);
        // dd($res->body());

        if (!$res->successful()) {
            //TODO ログを吐きたい
            return false;
        }

        if ($res->json("client_id") !== config('line.channel_id')) {
            return false;
        }

        if ((int) $res->json("expires_in") <= 0) {
            return false;
        }

        return $res->body();
    }

    public function lineProfileApiCall($token): array
    {
        return $this->apiCall($token, ApiConst::LINE_PROFILE_URL, 'get');
    }

    public function lineMessageApiCall($token, $message, $url): array
    {
        return $this->apiCall($token, $url, 'post', $message);
    }

    public function lineProfileByMessageApiCall($token, $userId): array
    {
        $url = ApiConst::LINE_MESSAGE_PROFILE_URL . $userId;
        return $this->apiCall($token, $url, 'get');
    }

    public function lineFollowersApiCall($token, $start = null, $followerIds = []): array
    {
        $url = ApiConst::LINE_MESSAGE_FOLLOWERS_URL;

        if (!$start) {
            $res = $this->apiCall($token, $url, 'get', ['limit' => 10]);
        } else {
            $res = $this->apiCall($token, $url, 'get', ['start' => $start]);
        }

        if (array_key_exists('next', $res)) {
            // レスポンスにnextプロパティが含まれる場合はメソッドを再帰呼び出しする。
            return $this->lineFollowersApiCall($token, $res["next"],  array_merge($followerIds, $res["userIds"]));
        } else {
            return array_merge($followerIds, $res["userIds"]);
        }
    }

    private function apiCall($token, $url, $method, $param = [])
    {
        $res = Http::withToken($token)->$method($url, $param);
        return json_decode($res->body(), true);
    }
}
