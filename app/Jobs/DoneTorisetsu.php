<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Kotobamu;
use App\Models\Application;
use App\Notifications\SendTorisetsuImage;
use App\Notifications\NoTorisetsu;
use App\Traits\LineApiCallable;

class DoneTorisetsu implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use LineApiCallable;

    public $event;

    /**
     * Create a new job instance.
     */
    public function __construct($event)
    {
        $this->event = $event;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $user = User::where("line_user_id", $this->event["source"]["userId"])->firstOrFail();

        $latest_torisetsu = $user->torisetsus()->orderBy('updated_at', 'DESC')->orderBy('id', 'DESC')->first();

        if ($latest_torisetsu && $latest_torisetsu->image_url) {
            // 画像をLINEで送る
            $user->notify(new SendTorisetsuImage($this->event["replyToken"], $latest_torisetsu->image_url));
        } else {
            // トリセツをまだ作成していない
            $user->notify(new NoTorisetsu($this->event["replyToken"]));
        }
    }
}
