<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // バリデーション
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // ユーザー認証
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user(); // ユーザー情報を取得
            $user->tokens()->delete(); // 既存のトークンを削除
            $token = $user->createToken("login:user{$user->id}")->plainTextToken;

            // `template`情報を含めてレスポンスを返す
            return response()->json([
                'token' => $token,
                'template' => $user->template // ユーザーの`template`を追加
            ], Response::HTTP_OK);
        }

        return response()->json('User unauthorized', Response::HTTP_UNAUTHORIZED);
    }
}
