<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Album;

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
            'template' => auth()->user()->template,
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

    public function send(Request $request, Album $album)
    {
        if ($album->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $album->is_sent = true;
        $album->save();

        return response()->json($album);
    }

    public function show(Album $album)
    {
        if ($album->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($album);
    }
}