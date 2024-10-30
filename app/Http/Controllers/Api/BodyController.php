<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Body;
use Barryvdh\DomPDF\Facade\PDF;


class BodyController extends Controller
{
    // ボディ情報を取得する
    public function showBody(Request $request, $albumid)
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
        if ($album->user_id !== auth()->id() || $album->is_sent) {
            return response()->json(['message' => 'Unauthorized or already sent'], 403);
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



    // ボディを更新する
    public function updateBody(Request $request, Album $album, Body $body)
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
        if ($album->user_id !== auth()->id() || $album->is_sent) {
            return response()->json(['message' => 'Unauthorized or already sent'], 403);
        }

         // アルバムIDからボディデータを取得
         $body = Body::where('albums_id', $album->id)->get();

        // リクエストからボディデータを取得してアルバムに設定
        /* $album->body = $request->input('body'); // リクエストからボディデータを取得
        $album->save(); // データベースに保存 */

        // ボディデータ格納とアルバムデータの保存
        $body->htmlContent = $request->input('body.htmlContent');
        $body->cssContent = $request->input('body.cssContent');
        $body->cssUrls = json_decode($request->input('body.cssUrls'), true);
        $body->localStorageData = json_decode($request->input('body.localStorageData'), true);
        $body->newImageDatabase1Data = json_decode($request->input('body.newImageDatabase1Data'), true);
        $body->imageDBData = json_decode($request->input('body.imageDBData'), true);
        $body->save();
        $album->save();

        return response()->json(['message' => 'ボディが更新されました', 'body' => $body], 200);
    }

    

    // ボディを送信する
    public function sendBody(Request $request, Album $album)
    {
        // ユーザーの権限をチェック
        if ($album->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        if ($album->is_sent) {
            return response()->json(['message' => 'Already sent'], 400);
        }

        $body = Body::where('albums_id', $album->id)->get();

        $album->is_sent = true;
        $album->save();


        // ボディのみを含むPDF生成を追加
        $pdf = PDF::loadView('pdf.album_body', ['body' => $body]);
        $pdf->save(storage_path('app/public/albums/' . $body->album_id . '_body.pdf'));

        return response()->json(['message' => 'ボディが送信され、PDFが生成されました', 'body' => $body], 200);
    }
}
