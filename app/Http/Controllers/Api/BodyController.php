<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Body;
use App\Models\User;
use Barryvdh\DomPDF\Facade\PDF;


class BodyController extends Controller
{
    // ボディ情報を取得する
    public function showBody($albumid)
    {
        $album = Album::findOrFail($albumid);
        $body = $album->body;

        if ($body) {
            // Bodyが存在する場合、データを返す
            return response()->json([
                'textData' => $body->textData,
                'imageData' => $body->imageData,
                'colors' => $body->colors,
            ]);
        }
    
        // Bodyが存在しない場合はそのまま返す
        return response()->json(null, 204); // 204 No Content
    }



    // ボディを作成または更新する
    public function createOrUpdateBody(Request $request, $albumid)
    {
        $request->validate([
            'textData' => 'required|JSON',
            'imageData' => 'required|JSON',
            'colors' => 'required|JSON',
        ]);  

        $album = Album::findOrFail($albumid);

        // ユーザーの権限をチェック
        if ($album->body_is_sent) {
            return response()->json(['message' => 'already sent'], 403);
        }

        $body = $album->body ?? new Body();
        $body->albums_id = $album->id;

        // ボディデータ格納とアルバムデータの保存
        $body->textData = $request->input('textData');
        $body->imageData = $request->input('imageData');
        $body->colors = $request->input('colors');
        $body->save();
        /* $body->touch(); */
        /* $album->save(); */

        return response()->json(['message' => 'ボディが保存されました', 'body' => $body], 201);
    }    

    // ボディを保存する
    public function sendBody($userid)
    {
        $user = User::findOrFail($userid);

        // ユーザーの権限をチェック
        if ($user->id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        if ($user->album->body_is_sent) {
            return response()->json(['message' => 'Already sent'], 400);
        }

        $user->album->body_is_sent = true;
        $user->album->save();

        return response()->json(['message' => 'ボディが送信されました'/* , 'body' => $body */], 200);
    }
}
