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

        // 名前を取得
        $name = $user->name;

        // 名前をJSON形式で返す
        return response()->json(['name' => $name]);
    }
}
