<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Album;
use PDF;
use Barryvdh\DomPDF\Facade as DomPDF;

class AlbumController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'cover' => 'nullable|string',
            'body' => 'nullable|string',
        ]);

        $album = Album::create([
            'user_id' => auth()->id(),
            'cover' => $request->cover,
            'body' => $request->body,
        ]);

        return response()->json($album, 201);
    }

    public function update(Request $request, Album $album)
    {
        if ($album->user_id !== auth()->id() || $album->is_sent) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'cover' => 'nullable|string',
            'body' => 'nullable|string',
        ]);

        $album->update($request->only('cover', 'body'));

        return response()->json($album);
    }

    public function send(Album $album)
    {
        // 認証されたユーザーがアルバムの所有者であることを確認
        if ($album->user_id !== auth()->id() || $album->is_sent) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // PDF生成のロジック
        // $pdf = DomPDF::loadView('albums.pdf', compact('album'));

        // PDFファイルの保存パスを指定
        $path = storage_path('app/public/albums/' . $album->id . '.pdf');

        // PDFを指定したパスに保存
        // $pdf->save($path);

        // アルバムの状態を更新
        $album->update(['is_sent' => true]);

        // 必要に応じて、管理画面へのアップロード処理を追加できます。
        // ここでは例として、PDFファイルのパスを返します。
        return response()->json([
            'message' => 'Album sent successfully',
            'pdf_path' => $path
        ]);
    }
}
