<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Torisetsu;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class wkhtmlJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $torisetsu;
    public $user;

    /**
     * Create a new job instance.
     */
    public function __construct($torisetsu)
    {
        $this->torisetsu = $torisetsu;
        $this->user = $torisetsu->user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $user_id = $this->user->id;

        $store_dir = "torisetsu_img/{$user_id}";

        $store_path = storage_path("app/public/{$store_dir}");
        if (!file_exists($store_path)) {
            $store_path = Storage::makeDirectory("public/{$store_dir}", 0777, true);
        }

        $public_path = public_path("storage/{$store_dir}");

        // トリセツのIDをファイル名にして作成する
        $image_path = "{$public_path}/{$this->torisetsu->id}.jpg";

        $torisetsu_url = route('torisetsu.latest', $this->user);
        $cmd = "wkhtmltoimage --zoom 2.0 --encoding shift_jis --width 1260 {$torisetsu_url} {$image_path}";

        exec($cmd, $output, $code);
        $this->torisetsu->image_stored_path = $image_path;
        $this->torisetsu->image_url = asset("storage/torisetsu_img/{$user_id}/{$this->torisetsu->id}.jpg");

        // 保存期間が過ぎたトリセツ画像を削除
        $this->torisetsu->image_deleted_at = Carbon::today()->addDays(config('torisetsu.image_expiration'));
        $this->torisetsu->save();
    }
}
