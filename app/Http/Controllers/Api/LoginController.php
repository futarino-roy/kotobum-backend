<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Sanctum\PersonalAccessToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use \Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    public function login(Request $request){
        // バリデーション
        $validator = Validator::make($request->all(), [
            'login_id' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // ユーザー認証
        if (Auth::attempt(['login_id' => $request->login_id, 'password' => $request->password])) {
            $user = User::where('login_id', $request->login_id)->first();
            $user->tokens()->delete();
            $token = $user->createToken("login:user{$user->id}")->plainTextToken;

            return response()->json([
                'token' => $token,
                'template' => $user->template
            ], Response::HTTP_OK);
        }

        return response()->json('User unauthorized', Response::HTTP_UNAUTHORIZED);
    }
}