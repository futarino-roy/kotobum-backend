<?php

namespace App\Http\Controllers\OriginalAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login_form()
    {
        if (Auth::guard('original_admins')->user()){
            return redirect()->route('kotobamu.index');
        }
        return view('original_admin.login_form');
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        //ユーザー情報が見つかったらログイン
        if (Auth::guard('original_admins')->attempt($credentials)) {
            //ログイン後に表示するページにリダイレクト
            return redirect()->route('kotobamu.index')->with([
                'login_msg' => 'ログインしました。',
            ]);
        }

        //ログインできなかったときに元のページに戻る
        return back()->withErrors([
            'login' => ['ログインに失敗しました'],
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('original_admins')->logout();
        $request->session()->regenerateToken();

        //ログインページにリダイレクト
        return redirect()->route('original_admin.login_form')->with([
            'logout_msg' => 'ログアウトしました',
        ]);
    }
}
