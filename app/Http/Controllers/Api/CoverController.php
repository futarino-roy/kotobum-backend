<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Cover;
use App\Models\User;
use Barryvdh\DomPDF\Facade\PDF;

class CoverController extends Controller
{
    // カバー情報を取得する
    public function showCover($albumid)
    {
        $album = Album::findOrFail($albumid);
        $cover = $album->cover;

        if ($cover) {
            // Bodyが存在する場合、データを返す
            return response()->json([
                'textData' => $cover->textData,
                'imageData' => $cover->imageData,
                'colors' => $cover->colors,
                'covertext'=> $cover->covertext,
            ]);
        }
    
        // Coverが存在しない場合はそのまま返す
        return response()->json(null, 204); // 204 No Content
    }



    // カバーを作成または更新する
    public function createOrUpdateCover(Request $request, $albumid)
    {
        $request->validate([
            'textData' => 'required|JSON',
            'imageData' => 'required|JSON',
            'colors' => 'required|JSON',
            'covertext' => 'required|JSON',
        ]);  

        $album = Album::findOrFail($albumid);

        // ユーザーの権限をチェック
        if ($album->cover_is_sent) {
            return response()->json(['message' => 'already sent'], 403);
        }

        $cover = $album->cover ?? new Cover();
        $cover->albums_id = $album->id;

        // ボディデータ格納とアルバムデータの保存
        $cover->textData = $request->input('textData');
        $cover->imageData = $request->input('imageData');
        $cover->colors = $request->input('colors');
        $cover->covertext = $request->input('covertext');
        $cover->save();
        /* $cover->touch(); */
        /* $album->save(); */

        return response()->json(['message' => 'カバーが保存されました', 'cover' => $cover], 201);
    }


    // カバーを保存する
    public function sendCover(Request $request,$id)
    {
        if($request->id === 'userId'){
            $user = User::findOrFail($id);

            // ユーザーの権限をチェック
            if ($user->id !== auth()->id()) {
                return response()->json(['message' => 'Unauthorized'], 403);
            }

            if ($user->album->cover_is_sent) {
                return response()->json(['message' => 'Already sent'], 400);
            }

            $user->album->cover_is_sent = true;
            $user->album->save();

        }elseif($request->id === 'albumId'){
            $album = Album::findOrFail($id);

            // ユーザーの権限をチェック
            if ($album->user_id !== auth()->id()) {
                return response()->json(['message' => 'Unauthorized'], 403);
            }

            if ($album->cover_is_sent) {
                return response()->json(['message' => 'Already sent'], 400);
            }

            $album->cover_is_sent = true;
            $album->save();
            
        }else{
            return response()->json(['message' => 'テーブルを指定してください'], 400);
        }

        return response()->json(['message' => 'ボディが送信されました'], 200);
    }
}
