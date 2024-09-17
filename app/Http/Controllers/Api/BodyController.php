<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Album;
use Barryvdh\DomPDF\Facade\PDF;

class BodyController extends Controller
{
    // ボディを作成または更新する
    public function createOrUpdateBody(Request $request, Album $album)
    {
        $request->validate([
            'body' => 'required|string',
        ]);

        if ($album->user_id !== auth()->id() || $album->is_sent) {
            return response()->json(['message' => 'Unauthorized or already sent'], 403);
        }

        $album->update(['body' => $request->body]);

        return response()->json($album, 201);
    }

    // ボディを更新する
    public function updateBody(Request $request, Album $album)
    {
        if ($album->user_id !== auth()->id() || $album->is_sent) {
            return response()->json(['message' => 'Unauthorized or already sent'], 403);
        }

        $request->validate([
            'body' => 'required|string',
        ]);

        $album->update(['body' => $request->body]);

        return response()->json($album);
    }

    // ボディを送信する
    public function sendBody(Request $request, Album $album)
    {
        if ($album->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        if ($album->is_sent) {
            return response()->json(['message' => 'Already sent'], 400);
        }

        $album->is_sent = true;
        $album->save();

        // ボディのみを含むPDF生成を追加
        $pdf = PDF::loadView('pdf.album_body', ['album' => $album]);
        $pdf->save(storage_path('app/public/albums/' . $album->id . '_body.pdf'));

        return response()->json($album);
    }
}

