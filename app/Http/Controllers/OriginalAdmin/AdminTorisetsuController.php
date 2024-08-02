<?php

namespace App\Http\Controllers\OriginalAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use app\Models\Torisetsu;


class AdminTorisetsuController extends Controller
{
    public function torisetsu_users(Request $request)
    {
        // フォームから送信されたフィルターを取得
        $date = $request->input('date');
        $gender = $request->input('gender');
        $state = $request->input('state');
        $name = $request->input('name');
        $line_display_name = $request->input('line_display_name');
        $birthday = $request->input('birthday');
        $torisetsuDateOrder = $request->input('latest_torisetsu_date');
        
    
        // ユーザーを取得するクエリを作成
        $baseQuery = User::all();

        //  // ユーザーを取得するクエリを作成
        //  $baseQuery = User::select('*');
        //  $baseQuery = $baseQuery->whereNotNull('gender')->get();
    
        // フィルターが指定されている場合は、クエリに追加する
        if ($date) {
            $carbonDate = Carbon::createFromFormat('Y-m', $date)->startOfDay();
            $baseQuery = $baseQuery->filter(function ($user) use ($carbonDate) {
                return $carbonDate->isSameMonth(Carbon::parse($user->created_at), true);
            });
        }

        // 最後に作成したトリセツの日付をフィルターリング
        if ($torisetsuDateOrder){
            $baseQuery = $baseQuery->filter(function ($user) use ($torisetsuDateOrder) {
                if ($user->torisetsus->last()){
                    $torisetsuLatestDate = Carbon::parse($user->torisetsus->last()->updated_at);
                    $carbonDate = Carbon::createFromFormat('Y-m',  $torisetsuDateOrder)->startOfDay();
                    return $carbonDate->isSameMonth($torisetsuLatestDate, true);
                } else {
                    return false;
                }
            });
        }
        
        if ($gender) {
            $baseQuery = $baseQuery->where('gender', $gender);
        }

        if ($state) {
            $baseQuery = $baseQuery->where('state', $state);
        }

        // 新たに追加：名前での検索
        if ($name) {
            $baseQuery = $baseQuery->filter(function ($user) use ($name) {
                return stripos($user->name, $name) !== false;
            });
        };

        // 新たに追加：ラインの名前での検索
        if ($line_display_name) {
            $baseQuery = $baseQuery->filter(function ($user) use ($line_display_name) {
                return stripos($user->line_display_name, $line_display_name) !== false;
            });
        };

        // 新たに追加：誕生日での検索
        if ($birthday) {
            $carbonDate = Carbon::createFromFormat('Y-m', $birthday)->startOfDay();
            $baseQuery = $baseQuery->filter(function ($user) use ($carbonDate) {
                if ($user->birthday){
                    return $carbonDate->isSameMonth(Carbon::parse($user->birthday), false);
                } else {
                    return false;
                }
            });
        }
    
        // フィルタリングされる前のユーザー数を取得
        $totalUsers = User::count();

        // フィルタリングされる前のユーザー数にトリセツを作成したユーザー数を追加
        $totalUsersWithTorisetsu = User::has('torisetsus')->count();

    
        // ビューにデータを渡して表示
        return view('original_admin.torisetsu.torisetsu_users', compact('baseQuery', 'totalUsers', 'totalUsersWithTorisetsu'));
    }

    public function torisetsu_opt()
    {
        return view('original_admin.torisetsu.torisetsu_opt');

    }
}