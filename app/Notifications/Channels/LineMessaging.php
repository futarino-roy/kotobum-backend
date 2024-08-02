<?php

namespace App\Notifications\Channels;

use App\Consts\ApiConst;
use App\Models\User;
use App\Traits\LineApiCallable;
use Exception;
use App\Notifications\LineMessageInterface;
use Illuminate\Support\Facades\Log;

/**
 * line messaging APIによる通知のチャネル
 */
class LineMessaging
{
    use LineApiCallable;

    public function send(User $notifiable, LineMessageInterface $notification)
    {
        if(is_null($notifiable->line_user_id)){
            throw new Exception("user_id: $notifiable->id. line_user_id is nothing.");
        }

        $message = json_decode($notification->getLineMessage($notifiable), true);
        $url = $notification->reply()
                    ? ApiConst::LINE_MESSAGE_REPLY_URL
                    : ApiConst::LINE_MESSAGE_PUSH_URL;

        $this->lineMessageApiCall(config('line.channel_access_token'), $message, $url);
        // Log::debug($r);
    }
}