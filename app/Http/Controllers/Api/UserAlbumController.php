<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Album;

class UserAlbumController extends Controller
{
    public function getOrCreateAlbum()
    {
        $userId = Auth::id();

        if (!$userId) {
            return response()->json(['error' => 'Unauthorized, please reauthenticate'], 401);
        }
        // ユーザーに関連するアルバムを取得または作成
        $album = Album::firstOrCreate(
            ['user_id' => $userId],
            ['body_is_sent' => false, 'cover_is_sent' => false, 'template' => null]
        );

        $group = $album->user->group;

        if ($group) {
            if ($album->user->id == $group->Auser_id) {
                // Auserに関連するAlbumのIDを取得
                $partner = $group->Buser && $group->Buser->album ? $group->Buser->album->id : null;
            } elseif ($album->user->id == $group->Buser_id) {
                // Buserに関連するAlbumのIDを取得
                $partner = $group->Auser && $group->Auser->album ? $group->Auser->album->id : null;
            } else {
                // 条件に合致しない場合、$partnerはnullになる
                $partner = null;
            }
        } else {
            // $groupがnullの場合、$partnerをnullに設定
            $partner = null;
        }

        return response()->json(['albumId' => $album->id, 'partner_id' => $partner ]);
    }

}
