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

        // 必要な情報を取得
        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'template' => $user->template,
        ]);
    }
}
