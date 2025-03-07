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

        foreach ($groups as $group) {
            if (!is_null($group->Auser_id) && !is_null($group->Buser_id)) {
                $group->plan = "ペア";
            } elseif (is_null($group->Auser_id) && is_null($group->Buser_id)) {
                $group->plan = "NULL";
            } else {
                $group->plan = "ソロ";
            }
        }

        /* 完了状態をどう判別する？ 
        foreach ($groups as $group) {
            if (!is_null($group->Auser_id) && !is_null($group->Buser_id)) {
                $group-> = "ペア";
            } elseif (is_null($group->Auser_id) && is_null($group->Buser_id)) {
                $group->plan = "NULL";
            } else {
                $group->plan = "ソロ";
            }
        } */

        // ダッシュボードビューを返す
        return view('admin.group_dashbord', compact('admin', 'groups'));
    }


    public function createGroup(Request $request) 
    {

    }


    public function showGroup($groupid)
    {
        // ログインしている管理者を取得
        $admin = Auth::guard('admin')->user();
        $group = Group::with(['Auser.Album', 'Buser.Album'])->findOrFail($groupid);

        return view('admin.GroupInformation', compact('admin', 'group'));
    }

    public function deleateGroup($groupid)
    {
        // Company をロード（Auser と Buser を含む）
        $group = Group::with('Auser.Album.body', 'Auser.Album.cover', 'Buser.Album.body', 'Buser.Album.cover')->findOrFail($groupid);

        // Auser の関連データ削除
        if ($group->Auser) {
            if ($group->Auser->Album) {
                if ($group->Auser->Album->body) {
                    $group->Auser->Album->body->delete();
                }
                if ($group->Auser->Album->cover) {
                    $group->Auser->Album->cover->delete();
                }
                $group->Auser->Album->delete();
            }
            // Auser を削除
            $group->Auser->delete();
        }

        // Buser の関連データ削除
        if ($group->Buser) {
            if ($group->Buser->Album) {
                if ($group->Buser->Album->body) {
                    $group->Buser->Album->body->delete();
                }
                if ($group->Buser->Album->cover) {
                    $group->Buser->Album->cover->$group->Buser->Album->delete();
                }
                // Buser を削除
                $group->Buser->delete();
            }
        }
        // group 削除前に名前を保持
        $groupName = $group->name;

        // group を削除
        $group->delete();

        // リダイレクトと成功メッセージ
        return redirect()->route('companies.index')->with('success', "{$groupName} を削除しました。");
    }

    public function createUser(Request $request)
    {

    }

    public function showUser($userid)
    {
        // ログインしている管理者を取得
        $admin = Auth::guard('admin')->user();
        $user = User::with(['Album.body', 'Album.cover'])->findOrFail($userid);

        return view('admin.UserInformation', compact('admin', 'user'));
    }

    public function deleteUser($userid)
    {
        $user = User::with('Group','Album.body', 'Album.cover')->findOrFail($userid);
        $group = $user->Group;

        if ($user->Alubm) {
            if ($user->Album->body) {
                $user->Album->body->delete();
            }
            if ($user->Album->cover) {
                $user->Album->Cover->delete();
            }
            $user->Album->delete();
        }

        // 最後にユーザーを削除
        $user->delete();

        // routeとセッション未設定
        return redirect()->route('users.index')->with('success', 'ユーザーと関連データを削除しました。');
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
