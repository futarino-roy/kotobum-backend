<?php

namespace App\Http\Controllers\OriginalAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserAdminController extends Controller
{
    // ユーザー管理画面の表示
    public function index(Request $request)
    {

        // LINEユーザを取得
        $lineUsers = User::whereNotNull('line_display_name')
                        ->where('is_blocking', false)
                        ->get();

        // 名前の検索機能
        $keyword = $request->input('keyword');
        if ($keyword) {
            $lineUsers = $lineUsers->filter(function ($user) use ($keyword) {
                return stripos($user->line_display_name, $keyword) !== false;
            });
        }else {
            $lineUsers = $lineUsers->take(10);
        }

        $admin_users = User::where('is_admin', true)
                        ->get();
                        

        return view('original_admin.user_admin.user_admin', compact('lineUsers', 'admin_users'));
    }

    public function admin_store(Request $req)
    {
        $all = $req->all();
        $user = User::find($all["user_id"]);
        $user->is_admin = true;
        $user->save(); 

        return redirect()->back()->with([
            'success' => '正常に登録されました',
        ]);
    }

    public function remove_admin(Request $req, User $user)
    {
        $user->is_admin = false;
        $user->save();
        
        return redirect()->back()->with([
            'success' => '正常に削除されました',
        ]);
    }
}
