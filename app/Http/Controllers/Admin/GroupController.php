<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{

    public function indexGroup()
    {
        // ログインしている管理者を取得
        $admin = Auth::guard('admin')->user();
        $groups = Group::get();

        if (!is_null($groups->Auser_id) && !is_null($groups->Buser_id)) {
            $plan = 2;
        } elseif (is_null($groups->Auser_id) || is_null($groups->Buser_id)) {
            $plan = 1;
        } else {
            $plan = 0;
        }
        
        // ダッシュボードビューを返す
        return view('admin.group_dashbord', compact('admin','groups','plan'));
    }



    public function createGroup(Request $request)
    {
        
    }



    public function showGroup($groupid)
    {
        // ログインしている管理者を取得
        $admin = Auth::guard('admin')->user();
        $group = Group::with(['Auser.Album', 'Buser.Album'])->get();
        
        

        return view('admin.partner', compact('admin','group','sent'));
    }


    /**
     * ユーザーを追加
     */
    public function setGroup(Request $request, $userid)
    {
        // リクエストバリデーション
        $request->validate([
            'new_partner_id' => 'required|exists:users,id|different:' . $userid,
        ]); 

        // 対象のユーザーを取得
        $user = User::findOrFail($userid);

        // パートナーを付け替え
        $user->switchPartner($request->input('new_partner_id'));

        return redirect()->route('admin.showPartner', $userid);
    }

    /**
     * 割り当てユーザーを削除
     */
    public function detachGroup($userid)
    {
        // 対象のユーザーを取得
        $user = User::findOrFail($userid);

        // パートナーを解除
        $user->detachPartner();

        return redirect()->route('admin.showPartner', $userid);
    }
}
