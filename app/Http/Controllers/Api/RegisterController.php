<?php

namespace App\Http\Controllers\Api; // apiフォルダにあるため末尾を"Api"に

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    public function register(Request $request)
{
    // リクエストのバリデーション
    $request->validate([
        'name' => 'required|string|max:255', // 名前は必須で、最大255文字
        'email' => 'required|string|email|max:255|unique:users,email', // メールは必須・正しい形式・ユニーク
        'password' => 'required|string|min:8|confirmed', // パスワードは必須・8文字以上・確認用パスワードと一致
    ]);

    // ユーザーを作成
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password), // パスワードをハッシュ化
    ]);

    return response()->json('User registration completed', Response::HTTP_OK);
}
}