<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    /**
     * パートナーを設定する
     */
    public function setPartner(Request $request, $userid)
    {
        // リクエストバリデーション
        $request->validate([
            'partner_id' => 'required|exists:users,id|different:' . $userid,
        ]);

        // 対象のユーザーを取得
        $user = User::findOrFail($userid);

        // パートナーを設定
        $user->setPartner($request->input('partner_id'));

        return ;
    }

    /**
     * パートナーを付け替える
     */
    public function switchPartner(Request $request, $userid)
    {
        // リクエストバリデーション
        $request->validate([
            'new_partner_id' => 'required|exists:users,id|different:' . $userid,
        ]);

        // 対象のユーザーを取得
        $user = User::findOrFail($userid);

        // パートナーを付け替え
        $user->switchPartner($request->input('new_partner_id'));

        return ;
    }

    /**
     * パートナーを解除する
     */
    public function detachPartner($userid)
    {
        // 対象の従業員を取得
        $user = User::findOrFail($userid);

        // パートナーを解除
        $user->detachPartner();

        return ;
    }
}
