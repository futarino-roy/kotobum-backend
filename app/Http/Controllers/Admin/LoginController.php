<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login_form()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.group_dashbord');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard')->with([
                'login_msg' => 'ログインしました。',
            ]);
        }

        return back()->withErrors([
            'login' => ['ログインに失敗しました'],
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login_form')->with([
            'logout_msg' => 'ログアウトしました',
        ]);
    }


    public function admin_user_redirect($userid,$parts)
    {
        if (Auth::guard('admin')->check()) {
            // 管理者情報を取得
            $admin = Auth::guard('admin')->user();
    
            // 対象ユーザーを取得
            $user = User::with(['group','Album'])->findOrFail($userid);
            $admin->tokens()->delete(); 
            $token = $admin->createToken('Admin Token')->plainTextToken;

            if (!$user->Album) {
                $user->Album = Album::firstOrCreate(
                    ['user_id' => $user->id],
                    ['body_is_sent' => false, 'cover_is_sent' => false, 'template' => null]
                );
            }

            $group = $user->group;

            if ($group) {
                if ($user->id == $group->Auser_id) {
                    // Auserに関連するAlbumのIDを取得
                    $partner = $group->Buser && $group->Buser->album ? $group->Buser->album->id : null;
                } elseif ($user->id == $group->Buser_id) {
                    // Buserに関連するAlbumのIDを取得
                    $partner = $group->Auser && $group->Auser->album ? $group->Auser->album->id : null;
                } else {
                    // 条件に合致しない場合、$partnerはnullになる
                    $partner = null;
                }
            } else {
                // $groupがnullの場合、$partnerをnullに設定
                $partner = null;
            }

            $queryParams = [
                'parts' => $parts,
                'format' => $user->format,
                'template' => $user->template,
                'albumId' => $user->Album->id,
                'partner_id' => $partner,
                'token' => $token,
            ];

            // 遷移先のURLを設定（外部ドメイン）
            $externalUrl = 'https://develop-front.kotobum.com/admin/index.html';

            // クエリパラメータをURLに付与
            $urlWithParams = $externalUrl . '?' . http_build_query($queryParams);

            return redirect()->away($urlWithParams);

        } else {
            // 管理者がログインしていない場合、ログインページにリダイレクト
            return redirect()->route('admin.login_form')->withErrors(['message' => '管理者としてログインしてください。']);
        }
    }
}

