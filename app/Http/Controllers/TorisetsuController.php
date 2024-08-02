<?php

namespace App\Http\Controllers;

use App\Http\Requests\TorisetsuRequest;
use App\Jobs\wkhtmlJob;
use Illuminate\Http\Request;
use Exception;
use App\Models\User;
use Illuminate\Support\Carbon;

class TorisetsuController extends Controller
{
    public function create(TorisetsuRequest $request)
    {
        $this->authorize("create", Torisetsu::class);

        $param = $request->all();
        $torisetsu = auth()->user()->torisetsus()->create($param);

        // torisetsu/{userId}のHTMLを呼び出しレンダリングするjob
        // 同期だと一生処理が完了しないのでjobで実行
        wkhtmlJob::dispatch($torisetsu);

        return response()->json([
            'data' => 'ok'
        ]);
    }

    // ログインユーザの最新のトリセツをHTMLで表示する
    public function latest(User $user)
    {
        $latest_torisetsu = $user->torisetsus()->orderBy('created_at', 'DESC')->orderBy('id', 'DESC')->first();
        // dd($latest_torisetsu);
        $name = $latest_torisetsu->name ?: $user->nick_name;
        $date = Carbon::parse($latest_torisetsu->updated_at)->format("Y年m月d日");
        return view('torisetsu.latest', compact('latest_torisetsu', 'name', 'date'));
    }

    // ログインユーザの最新のトリセツ画像のURLを返す
    public function latest_url()
    {
        $latest_torisetsu = auth()->user()->torisetsus()->orderBy('created_at', 'DESC')->orderBy('id', 'DESC')->first();
        if ($latest_torisetsu && $latest_torisetsu->image_url) {
            return response()->json([
                'data' => $latest_torisetsu->image_url
            ]);
        } else {
            return response()->json([
                'data' => null
            ]);
        }
    }
}
