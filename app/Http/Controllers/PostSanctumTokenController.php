<?php

namespace App\Http\Controllers;

use App\Http\Requests\IsRegisted;
use App\Http\Requests\UpdateUserRequest;
use App\Jobs\KotobamuApply;
use App\Jobs\DoneTorisetsu;
use App\Jobs\UpdateLastActionAt;
use App\Models\Kotobamu;
use App\Models\User;
use App\Services\UtilService;
use App\Traits\LineApiCallable;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostSanctumTokenController extends Controller
{
    use LineApiCallable;

    function is_registed(IsRegisted $req)
    {
        $result = $this->lineOauthApiCall($req->line_access_token);
        if (!$result) {
            //verifyできない。
            return response()->json(["data" => ["result" => "failed", "message" => "unexpecetd parameter or value."]]);
        }
        $result = $this->lineProfileApiCall($req->line_access_token);

        $user = User::where("line_user_id", $result["userId"])->first();

        if (is_null($user)) {
            return response()->json(["data" => ["result" => "false"]]);
        }

        $user->fill([
            "line_access_token" => $req->line_access_token,
            "line_access_token_expired" => now()->addMinutes(config('sanctum.expiration'))
        ]);
        $user->save();

        return response()->json(["data" => ["result" => "true"]]);
    }

    function regist(IsRegisted $req)
    {
        $result = $this->lineOauthApiCall($req->line_access_token);
        if (!$result) {
            //verifyできない。
            return response()->json(["data" => ["result" => "failed", "message" => "unexpecetd parameter or value."]], 400);
        }
        $result = $this->lineProfileApiCall($req->line_access_token);

        $user = User::where("line_user_id", $result["userId"])->first();

        if (!is_null($user)) {
            return response()->json(["data" => ["result" => "ng", "message" => "既に登録されています"]], 400);
        }

        $user = User::create([
            "line_user_id" => $result["userId"],
            "line_access_token" => $req->line_access_token,
            "line_display_name" => $result["displayName"],
            "line_access_token_expired" => now()->addMinutes(config('sanctum.expiration'))
        ]);

        $user["line_picture_url"] = array_key_exists('pictureUrl', $result) ? $result["pictureUrl"] : null;
        $user->save();

        return response()->json(["data" => ["result" => "ok"]]);
    }

    /**
     * messaging APIからのwebhook受付用
     */
    public function webhook(Request $req)
    {
        // requestが本当にlineからなのか検証
        // @see https://developers.line.biz/ja/reference/messaging-api/#signature-validation
        $channelSecret = config("line.channel_secret");
        $httpRequestBody = $req->getContent();
        $hash = hash_hmac('sha256', $httpRequestBody, $channelSecret, true);
        $signature = base64_encode($hash);
        $x_line_signature = $req->headers->get("x-line-signature");

        //不正リクエスト
        if (app()->isProduction()) {
            if ($signature !== $x_line_signature) return response()->json("{}");
        }

        $events = $req->all()["events"];

        foreach ($events as $event) {
            if ($event["type"] === "message") {
                if ($event["message"]["type"] === "text") {
                    $keyword = $event["message"]["text"];
                    if (Str::is("トリセツの入力を完了しました*", $keyword) || Str::is("トリセツ作成完了*", $keyword)) {
                        DoneTorisetsu::dispatch($event);
                        continue;
                    }
                    $kotobamus = Kotobamu::where('is_open', true)->get();
                    // ユーザが入力したワードの一部(またはすべて)と一致するキーワードを持つコトバムを探す
                    $kotobamus = $kotobamus->filter(function ($kotobamu) use ($keyword) {
                        return Str::contains($keyword, $kotobamu->keyword);
                    });
                    // 該当するコトバムすべてに対してユーザからの申請をする
                    if (count($kotobamus) !== 0) {
                        KotobamuApply::dispatch($event, $keyword, $kotobamus);
                    }
                }
                // なんらかのメッセージを送ったユーザのlast_action_atフィールドを更新
                UpdateLastActionAt::dispatch($event);
            } elseif ($event["type"] === "follow") {
                // 友達追加 or ブロック解除時にDBにユーザ追加
                $util = new UtilService();
                $util->CreateUserFromLineId($event["source"]["userId"]);
            } elseif ($event["type"] === "unfollow") {
                UtilService::DeleteUserFromLineId($event["source"]["userId"]);
            }
        }

        return response()->json(["ok"]);
        // この形式で飛んでくる
        /*
            {
                "destination": "xxxxxxxxxx",
                "events": [
                    {
                        "type": "message",
                        "message": {
                            "type": "text",
                            "id": "14353798921116",
                            "text": "Hello, world"
                        },
                        "timestamp": 1625665242211,
                        "source": {
                            "type": "user",
                            "userId": "U80696558e1aa831..."
                        },
                        "replyToken": "757913772c4646b784d4b7ce46d12671",
                        "mode": "active",
                        "webhookEventId": "01FZ74A0TDDPYRVKNK77XKC3ZR",
                        "deliveryContext": {
                            "isRedelivery": false
                        }
                    },
                    {
                        "type": "follow",
                        "timestamp": 1625665242214,
                        "source": {
                            "type": "user",
                            "userId": "Ufc729a925b3abef..."
                        },
                        "replyToken": "bb173f4d9cf64aed9d408ab4e36339ad",
                        "mode": "active",
                        "webhookEventId": "01FZ74ASS536FW97EX38NKCZQK",
                        "deliveryContext": {
                            "isRedelivery": false
                        }
                    },
                    ...
                ]
            }
        */
    }


    function test(Request $req)
    {
        // $r = Room::find(5);
        // var_dump(spl_object_id($r));
        // dd($r->relations->pluck('user_id'));
        // dd($r->partner_users);
        $u = User::find(3);
        // $u->notify(new FeedbackStart('event_event'));
        // $fb = Feedback::where(['a_user_id' => 3, 'b_user_id' => 4, 'room_id' => 401])->first();
        // $u->notify(new FeedbackResult($fb));
        return response()->json(["ok" => true]);
    }

    public function hookMock()
    {
        return [
            "source" => [
                "userId" => "U91eeaf62d",
                "type" => "user"
            ],
            'type' => 'postback',
            'postback' => [
                'data' => '{"type": "today_mood", "mood": 2, "reason": 5}',
            ],
            'webhookEventId' => '01H4FC80ZFDQJS0YF1BP52KGQ9',
            'deliveryContext' => [
                'isRedelivery' => false,
            ],
            'timestamp' => 1688438309369,
            'source' =>
            [
                'type' => 'user',
                'userId' => 'Udd361f2aef833c033626290e142a63d4',
            ],
            'replyToken' => '9e8e25be1bfd4918a132329ecb771dd0',
            'mode' => 'active',
        ];
    }
}
