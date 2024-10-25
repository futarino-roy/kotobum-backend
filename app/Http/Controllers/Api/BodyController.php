<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Body;
use Barryvdh\DomPDF\Facade\PDF;

class BodyController extends Controller
{
    // ボディを作成または更新する
    public function createOrUpdateBody(Request $request, Album $album)
    {
        $request->validate([
            'htmlContent' => 'required|string',
            'cssContent' => 'nullable|string',
            'cssUrls' => 'nullable|string',
            'localStorageData' => 'nullable|string',
            'newImageDatabase1Data' => 'nullable|string',
            'imageDBData' => 'nullable|string',
        ]);  

        // ユーザーの権限をチェック
        if (/* $album->user_id !== auth()->id() || */ $album->is_sent) {
            return response()->json(['message' => 'Unauthorized or already sent'], 403);
        }

        // ボディデータを作成
        $body = new Body();
        $body->albums_id = $album->id;

        // リクエストからボディデータを取得
        // $body = $request->input('body'); // リクエストからボディデータを取得
        // $album->body = $body; // アルバムのボディを更新
        // $album->save(); // データベースに保存

        // ボディデータ格納とアルバムデータの保存
        $body->htmlContent = $request->input('htmlContent');
        $body->cssContent = $request->input('cssContent');
        $body->cssUrls = $request->input('cssUrls');
        $body->localStorageData = $request->input('localStorageData');
        $body->newImageDatabase1Data = $request->input('newImageDatabase1Data');
        $body->imageDBData = $request->input('imageDBData');
        $body->save();
        $album->save();

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
