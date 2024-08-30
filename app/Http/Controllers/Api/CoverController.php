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

        if ($album->user_id !== auth()->id() || $album->is_sent) {
            return response()->json(['message' => 'Unauthorized or already sent'], 403);
        }

        $album->update(['cover' => $request->cover]);

        return response()->json($album, 201);
    }

    // カバーを更新する
    public function updateCover(Request $request, Album $album)
    {
        if ($album->user_id !== auth()->id() || $album->is_sent) {
            return response()->json(['message' => 'Unauthorized or already sent'], 403);
        }

        $request->validate([
            'cover' => 'required|string',
        ]);

        $album->update(['cover' => $request->cover]);

        return response()->json($album);
    }

    // カバーを送信する
    public function sendCover(Request $request, Album $album)
    {
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

        return response()->json($album);
    }
}
