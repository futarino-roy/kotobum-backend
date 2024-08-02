<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Message;
use Illuminate\Support\Carbon;
use App\Notifications\SendKotobamuMessage;
use App\Notifications\SendErrorMessage;
use App\Notifications\SendSuccssMessage;
use App\Notifications\SendImageMessage;
use App\Notifications\SendAudioMessage;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class SendMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:send-message';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'コトバムメッセージをユーザに送信する';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();
        $today_messages = Message::whereDate('send_at', '=', $now)->get();
        $target_messages = $today_messages->filter(function ($message) use ($now) {
            // send_at == (nowを60分切り下げた時刻)かつユーザが承認済みならメッセージを送る
            return $message->send_at === $now->subMinutes($now->minute % 60)->format('Y-m-d H:00:00') && $message->application->is_approved;
        });

        foreach ($target_messages as $message) {
            $user = $message->application->user;
            $message_content = $message->content;
            $image_url = $message->image_path ? asset($message->image_path) : null;
            $audio_url = $message->audio_url ?: null;
            // テキスト(必須),画像,音声のメッセージを送る
            // $user->notify(new SendKotobamuMessage($message_content, $image_url, $audio_url));
            try {
                if ($user->is_blocking){
                    throw new \Exception("エラーだよ");
                }
                // dd($user);
                $user->notify(new SendKotobamuMessage($message_content, $image_url, $audio_url));
                $message->is_sent=true;
                $message->save();
                foreach (User::admins()->get() as $admin) {
                    $admin->notify(new SendSuccssMessage($user));
                }
            } catch (\Exception $e) {
                $message->is_sent=false;
                $message->save();
                foreach (User::admins()->get() as $admin) {
                    $admin->notify(new SendErrorMessage($user));
                }
            }
        }
    }
}
