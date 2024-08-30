<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAlbumController extends Controller
{
    public function getAlbum(Request $request)
    {
        $userId = Auth::id();
        
        // ユーザーに関連するアルバムを取得
        $album = \App\Models\Album::where('user_id', $userId)->first();

        if ($album) {
            return response()->json(['albumId' => $album->id]);
        } else {
            return response()->json(['message' => 'No album found'], 404);
        }
    }
}
