<?php

namespace App\Http\Controllers\Api;

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
        // バリデーション
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|email',
            'password' => 'required|string|min:8',
            'template' => 'required|string',
        ]);

        // バリデーションエラーがあればレスポンスを返す
        if ($validator->fails()) {
            // \Log::info('Validation failed', $validator->messages()->toArray());
            return response()->json($validator->messages(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // ユーザーを作成
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'template' => $request->template,
        ]);

        // トークンを生成
        $token = $user->createToken('Personal Access Token')->plainTextToken;

        return response()->json([
            'message' => 'User registration completed',
            'token' => $token,
            'user' => $user
        ], Response::HTTP_OK);
    }
}