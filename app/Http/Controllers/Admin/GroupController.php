<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GroupController extends Controller
{

    public function indexGroup()
    {
        // ログインしている管理者を取得
        $admin = Auth::guard('admin')->user();
        $groups = Group::get();

        // ペアになったら戻らん？
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
        // バリデーション
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'format' => 'required|integer',
        ]);

        // グループ作成（Auser, Buser はNULLのまま）
        $group = Group::create([
            'name' => $validated['name'],
            'format' => $validated['format'],
            'Auser_id' => null,
            'Buser_id' => null,
        ]);

        return redirect()->back()->with('message', 'グループが作成されました。')->with('group', $group);
    }




    public function showGroup($groupid)
    {
        // ログインしている管理者を取得
        $admin = Auth::guard('admin')->user();
        $group = Group::with(['Auser.Album.body', 'Buser.Album.body'])->findOrFail($groupid);

        $imageDataA = null;
        $imageDataB = null;
        if (isset($group->Auser->Album->body->imageData)) {
            $imageDataA = json_decode($group->Auser->Album->body->imageData, true);
        }
        if (isset($group->Buser->Album->body->imageData)) {
            $imageDataB = json_decode($group->Buser->Album->body->imageData, true);
        }

        return view('admin.GroupInformation', compact('admin', 'group', 'imageDataA', 'imageDataB'));
    }



    public function deleteGroup($groupid)
    {
        // Group をロード（Auser と Buser を含む）
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
        return redirect()->route('admin.group_dashbord')->with('success', "{$groupName} を削除しました。");
    }



    public function createUser(int $groupid, Request $request)
    {
        // バリデーション
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'login_id'  => 'required|string|unique:users',
            'password'  => 'required|string|min:8',
            'format'    => 'required|integer',
        ]);

        // グループ取得
        $group = Group::find($groupid);
        if (!$group) {
            return response()->json(['error' => '指定されたグループが存在しません。'], Response::HTTP_NOT_FOUND);
        }

        // どちらのユーザーを作成するか判定
        if ($group->Buser_id === null) {
            // Buser を作成
            $user = User::create([
                'name'     => $validated['name'],
                'login_id' => $validated['login_id'],
                'password' => Hash::make($validated['password']),
                'template' => 'B',
                'format'   => $validated['format'],
                'group_id' => $group->id,
            ]);
            $group->update(['Buser_id' => $user->id]);
            $role = 'Buser';
        } elseif ($group->Auser_id === null) {
            // Auser を作成（Buser がすでにいる場合のみ）
            $user = User::create([
                'name'     => $validated['name'],
                'login_id' => $validated['login_id'],
                'password' => Hash::make($validated['password']),
                'template' => 'A',
                'format'   => $validated['format'],
                'group_id' => $group->id,
            ]);
            $group->update(['Auser_id' => $user->id]);
            $role = 'Auser';
        } else {
            return response()->json(['error' => 'このグループにはすでにAuserとBuserが存在します。'], Response::HTTP_BAD_REQUEST);
        }

        return redirect()->back()->with('message', "{$role} が作成され、グループに関連付けられました。")->with('user', $user)->with('group', $group);
    }



    public function showUser($userid)
    {
        // ログインしている管理者を取得
        $admin = Auth::guard('admin')->user();
        $user = User::with(['Group','Album.body', 'Album.cover'])->findOrFail($userid);

        $textData = json_decode($user->Album->body->textdata,true); 
        $imageData = json_decode($user->Album->body->imageData, true);

        return view('admin.UserInformation', compact('admin', 'user', 'textData', 'imageData'));
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
        return redirect()->route('admin.group_infomation',$group->id)->with('success', 'ユーザーと関連データを削除しました。');
    }
}
