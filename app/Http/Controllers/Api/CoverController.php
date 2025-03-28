<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Cover;
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



    // カバーを更新する(現在不使用)
    public function updateCover(Request $request, Album $album)
    {
        $request->validate([
            'htmlContent' => 'required|string',
            'cssContent' => 'required|string',
            'cssUrls' => 'required|json',
            'localStorageData' => 'required|json',
            'newImageDatabase1Data' => 'required|json',
            'imageDBData' => 'required|json',
        ]);

        // ユーザーの権限をチェック
        if ($album->user_id !== auth()->id() || $album->cover_is_sent) {
            return response()->json(['message' => 'Unauthorized or already sent'], 403);
        }

        // アルバムIDからカバーデータを取得
        $cover = Cover::where('albums_id', $album->id)->get();

        // リクエストからカバーデータを取得してアルバムに設定
        /* $album->cover = $request->input('cover'); // リクエストからカバーデータを取得
        $album->save(); // データベースに保存 */

        // カバーデータ格納とアルバムデータの保存
        $cover->htmlContent = $request->input('cover.htmlContent');
        $cover->cssContent = $request->input('cover.cssContent');
        $cover->cssUrls = json_decode($request->input('cover.cssUrls'), true);
        $cover->localStorageData = json_decode($request->input('cover.localStorageData'), true);
        $cover->newImageDatabase1Data = json_decode($request->input('cover.newImageDatabase1Data'), true);
        $cover->imageDBData = json_decode($request->input('cover.imageDBData'), true);
        $cover->save();
        $album->save();

        return response()->json(['message' => 'カバーが更新されました', 'cover' => $cover], 200);
    }



    // カバーを保存する
    public function sendCover($albumid)
    {
        $album = Album::findOrFail($albumid);

        // ユーザーの権限をチェック
        if ($album->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        if ($album->cover_is_sent) {
            return response()->json(['message' => 'Already sent'], 400);
        }

        /* $cover = Cover::where('albums_id', $album->id)->get(); */

        $album->cover_is_sent = true;
        $album->save();

        // カバーのみを含むPDF生成を追加
        /* $pdf = PDF::loadView('pdf.album_cover', ['album' => $cover]);
        $pdf->save(storage_path('app/public/albums/' . $cover->album_id . '_cover.pdf')); */

        return response()->json(['message' => 'カバーが送信されました'/* , 'cover' => $cover */], 200);
    }
}
