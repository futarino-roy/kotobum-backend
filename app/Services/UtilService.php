<?php

namespace App\Services;

use App\Models\Application;
use App\Models\Kotobamu;
use App\Models\User;
use App\Traits\LineApiCallable;

/**
 * 便利に使いそうなもの何でも入れようクラス
 */
class UtilService
{
    use LineApiCallable;

    public static function CreateKotobamuApplication(User $user, Kotobamu $kotobamu, string $input_keyword = null, bool $is_approved = null)
    {
        // 既に申請済みでないか確認
        $application = Application::where('kotobamu_id', $kotobamu->id)
            ->where('user_id', $user->id)->first();

        if (!$application) {
            Application::create([
                "user_id" => $user->id,
                "kotobamu_id" => $kotobamu->id,
                "input_keyword" => $input_keyword,
                "is_approved" => $is_approved
            ]);
        } else {
            // 再追加の場合は強制的に申請中にする(非承認した申請も再追加すると申請中になる)
            $application->fill(
                [
                    "input_keyword" => $input_keyword,
                    "is_approved" => null
                ]
            );
            $application->save();
        }
    }

    public function CreateUserFromLineId(string $line_user_id)
    {
        $result = $this->lineProfileByMessageApiCall(config('line.channel_access_token'), $line_user_id);
        $user = User::where('line_user_id', $result["userId"])->first();
        // userIdがフタリノDBに登録されていなければ新規作成
        if (!$user) {
            $user = User::create([
                "line_user_id" => $line_user_id,
            ]);
        }
        $user->line_display_name = $result["displayName"];
        $user->line_picture_url = array_key_exists('pictureUrl', $result) ? $result["pictureUrl"] : null;
        $user->is_blocking = false;
        $user->save();

        return $user;
    }

    public static function DeleteUserFromLineId(string $line_user_id)
    {
        $user = User::where('line_user_id', $line_user_id)->first();
        $user->is_blocking = true;
        $user->save();

        return $user;
    }
}
