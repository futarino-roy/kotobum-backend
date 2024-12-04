<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartnerController extends Controller
{
    public function showPartner($userid)
    {
        // ログインしている管理者を取得
        $admin = Auth::guard('admin')->user();
        $user = User::findOrFail($userid);

        /* dd($userid); */
        

        if($user->template == 'A'){
            $A = User::with('Album')->find($userid);
            $B = User::with('Album')->find($user->partner_id) ?? null;
        }else{
            $A = User::with('Album')->find($user->partner_id) ?? null;
            $B = User::with('Album')->find($userid);
        }

        /* dd(User::with('Album')->find($userid)); */
        /* dd(User::with('Album')->find($user->partner_id)); */

        $users = User::with('Album','partner')->get();
        $solo = is_null($A) || is_null($B);

        return view('admin.partner', compact('admin','users','A','B','solo'));
    }


    /**
     * パートナーを付け替える
     */
    public function switchPartner(Request $request, $userid)
    {
        dd($request);
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
     * パートナーを解除する
     */
    public function detachPartner($userid)
    {
        // 対象のユーザーを取得
        $user = User::findOrFail($userid);

        // パートナーを解除
        $user->detachPartner();

        return redirect()->route('admin.showPartner', $userid);
    }
}
