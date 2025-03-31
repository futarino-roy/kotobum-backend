<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function show(Request $request)
    {
        // ユーザー情報を取得
        $user = $request->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized, please reauthenticate'], 401);
        }

        if (!$user->Album) {
            $bodySent = false;
            $coverSent = false;
        }else{
            $bodySent = $user->Album->body_is_sent;
            $coverSent = $user->Album->cover_is_sent;
        }
        

        // 必要な情報を取得
        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'login_id' => $user->login_id,
            'template' => $user->template,
            'format' => $user->format,
            'bodySent' => $bodySent,
            'coverSent' => $coverSent,
        ]);
    }
}
