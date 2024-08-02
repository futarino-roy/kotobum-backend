<?php

use App\Models\Kotobamu;
use App\Models\Message;
use App\Models\Torisetsu;
use App\Models\User;
use Dompdf\FrameDecorator\Text;
use Illuminate\Support\Carbon;
use Carbon\CarbonImmutable;
use phpDocumentor\Reflection\Types\Boolean;
use PhpParser\Node\Expr\Cast\String_;

if (!function_exists('zero_content_by_situation')) {
    function zero_content_by_situation(int $torisetsu): bool
    {
        $torisetsu = Torisetsu::find($torisetsu);

        if ($torisetsu->when_depressed) {
            return false;
        } elseif ($torisetsu->when_sick) {
            return false;
        } elseif ($torisetsu->for_making_up) {
            return false;
        } elseif ($torisetsu->when_bad_mood) {
            return false;
        }

        return true;
    }
}

if (!function_exists('is_future_message')) {
    function is_future_message(int $message_id): bool
    {
        $message = Message::find($message_id);

        return Carbon::parse($message->send_at)->isFuture();
    }
}

// 文字コードとしての改行を文字列としての「\n」に変えるヘルパー（LINE通知用）
if (!function_exists('nl2string_nl')) {
    function nl2string_nl(string $text): string
    {
        $text = str_replace("\r", "", $text);
        return str_replace("\n", "\\n", $text);
    }
}

// 指定したコトバムに紐づくユーザ全員にメッセージを1通以上作成済みか
if (!function_exists('messages_created')) {
    function messages_created(int $kotobamu_id): bool
    {
        $kotobamu = Kotobamu::find($kotobamu_id);
        $approved_applications = $kotobamu->applications->where('is_approved', true);

        if (count($approved_applications) === 0) {
            return false;
        } else {
            foreach ($approved_applications as $application) {
                if ($application->messages->first()) {
                    continue;
                } else {
                    return false;
                }
            }
            return true;
        }
    }
}

// その月の送信予定メッセージ数を返す（デフォルトは今月）
if (!function_exists('message_count')) {
    function message_count(int $offset_from_this_month = 0)
    {
        $today = CarbonImmutable::today();
        $applicable_month_day = $today->addMonths($offset_from_this_month);

        $start_of_this_month = $applicable_month_day->firstOfMonth();
        $end_of_this_month = $applicable_month_day->endOfMonth();

        $messages = Message::whereDate('send_at', ">=", $start_of_this_month)
            ->whereDate('send_at', "<=", $end_of_this_month)->get();
        $messages = $messages->filter(function ($message) {
            return $message->application->is_approved;
        });

        $message_count = 0;
        foreach ($messages as $message) {
            if ($message->content) {
                $message_count++;
            }
            if ($message->audio_url) {
                $message_count++;
            }
            if ($message->image_path) {
                $message_count++;
            }
        }
        return $message_count;
    }
}
