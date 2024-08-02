<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use App\Traits\LineApiCallable;
use Illuminate\Console\View\Components\Line;

class LineFollowersPutInDb extends Command
{
    use LineApiCallable;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:line-followers-put-in-db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '公式LINEの友達をDBに入れるコマンド(本番へデプロイ時に自動実行)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // 公式LINEの友達のline_user_id一覧
        $followerLineIds = $this->lineFollowersApiCall(config('line.channel_access_token'));
        $userLineIds = User::all()->pluck('line_user_id')->all();

        $diffLineIds = array_diff($followerLineIds, $userLineIds);

        foreach ($diffLineIds as $lineId) {
            $result = $this->lineProfileByMessageApiCall(config('line.channel_access_token'), $lineId);
            $user = User::create([
                "line_user_id" => $result["userId"],
                "line_display_name" => $result["displayName"]
            ]);
            $user["line_picture_url"] = array_key_exists('pictureUrl', $result) ? $result["pictureUrl"] : null;
            $user->save();
        }
    }
}
