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

        // ユーザーに関連するアルバムを取得または作成
        $album = Album::firstOrCreate(
            ['user_id' => $userId],
            ['is_sent' => false, 'template' => null]
        );

        return response()->json(['albumId' => $album->id]);
}

}
