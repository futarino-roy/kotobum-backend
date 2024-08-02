<?php

namespace App\Console\Commands;

use App\Models\Torisetsu;
use Illuminate\Support\Facades\File;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class DeleteTorisetsu extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:delete-torisetsu';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '保存期限を過ぎたトリセツ画像を削除するコマンド';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $target_torisetsus = Torisetsu::all();

        $target_torisetsus = $target_torisetsus->filter(function ($torisetsu) {
            return Carbon::parse($torisetsu->image_deleted_at)->isPast();
        });

        foreach ($target_torisetsus as $target_torisetsu) {
            if (File::exists($target_torisetsu->image_stored_path)) {
                File::delete($target_torisetsu->image_stored_path);
                $target_torisetsu->image_stored_path = null;
                $target_torisetsu->image_url = null;
                $target_torisetsu->save();
            }
        }
    }
}
