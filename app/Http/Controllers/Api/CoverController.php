<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Album;
use Barryvdh\DomPDF\Facade\PDF;

class CoverController extends Controller
{
    // カバーを作成または更新する
    public function createOrUpdateCover(Request $request, Album $album)
    {
        $request->validate([
            'cover' => 'required|string',
        ]);

        // ユーザーの権限をチェック
        if ($album->user_id !== auth()->id() || $album->is_sent) {
            return response()->json(['message' => 'Unauthorized or already sent'], 403);
        }

        // リクエストからカバーデータを取得してアルバムに設定
        $cover = $request->input('cover'); // リクエストからカバーデータを取得
        $album->cover = $cover; // アルバムのカバーを更新
        $album->save(); // データベースに保存

        return response()->json(['message' => 'カバーが保存されました', 'album' => $album], 201);
    }

    // カバーを更新する
    public function updateCover(Request $request, Album $album)
    {
        // ユーザーの権限をチェック
        if ($album->user_id !== auth()->id() || $album->is_sent) {
            return response()->json(['message' => 'Unauthorized or already sent'], 403);
        }

        $request->validate([
            'cover' => 'required|string',
        ]);

        // リクエストからカバーデータを取得してアルバムに設定
        $album->cover = $request->input('cover'); // リクエストからカバーデータを取得
        $album->save(); // データベースに保存

        return response()->json(['message' => 'カバーが更新されました', 'album' => $album], 200);
    }

    // カバーを送信する
    public function sendCover(Request $request, Album $album)
    {
        // ユーザーの権限をチェック
        if ($album->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        if ($album->is_sent) {
            return response()->json(['message' => 'Already sent'], 400);
        }

        $album->is_sent = true;
        $album->save();

        // カバーのみを含むPDF生成を追加
        $pdf = PDF::loadView('pdf.album_cover', ['album' => $album]);
        $pdf->save(storage_path('app/public/albums/' . $album->id . '_cover.pdf'));

        return response()->json(['message' => 'カバーが送信され、PDFが生成されました', 'album' => $album], 200);
    }
}
