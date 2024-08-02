<?php

namespace App\Http\Controllers\OriginalAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateKotobamuRequest;
use App\Models\Kotobamu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Traits\LineApiCallable;

class KotobamuController extends Controller
{
    use LineApiCallable;

    public function index(Request $req)
    {
        $kotobamus = Kotobamu::all();

        $keyword = $req->input('keyword');
        if (!empty($keyword)) { //$keyword　が空ではない場合、検索処理を実行します
            $searched_kotobamus = Kotobamu::where('keyword', 'LIKE', "%{$keyword}%")->get();
        } else {
            $searched_kotobamus = Kotobamu::all();
        }

        // メッセージセッティング済のコトバム
        $no_message_kotobamus = $searched_kotobamus->filter(function ($kotobamu) {
            return !messages_created($kotobamu->id);
        });
        // メッセージ未設定のコトバム
        $has_message_kotobamus = $searched_kotobamus->filter(function ($kotobamu) {
            return messages_created($kotobamu->id);
        });

        $no_message_kotobamus = $no_message_kotobamus->sortByDesc('created_at');
        $has_message_kotobamus = $has_message_kotobamus->sortByDesc('created_at');
        return view('original_admin.kotobamu.index', compact('no_message_kotobamus', 'has_message_kotobamus', 'keyword'));
    }

    public function link_from_followers(Request $req, Kotobamu $kotobamu)
    {
        $is_approved = $kotobamu->applications->where('is_approved', 1);
        $is_applying = $kotobamu->applications->whereNull('is_approved');

        $keyword = $req->input('keyword');
        if (!empty($keyword)) { //$keyword　が空ではない場合、検索処理を実行します
            $followers = User::where('line_display_name', 'LIKE', "%{$keyword}%")->where('is_blocking', false)->get();
        } else {
            $followers = User::where('is_blocking', false)->get()->sortByDesc('last_action_at')->slice(0, 10);
        }
        return view('original_admin.kotobamu.link_from_followers', compact('kotobamu', 'followers', 'is_approved', 'is_applying', 'keyword'));
    }

    public function store(Request $req)
    {
        // バリデーション
        $validated = $req->validate(
            [
                'keyword' => 'required|unique:kotobamus',
                'done_on' => 'nullable|date'
            ],
            [
                'keyword.required' => 'コトバムキーワードの入力は必須です',
                'keyword.unique' => 'そのコトバムキーワードは既に登録されています'
            ]
        );

        Kotobamu::create(
            $validated
        );
        return redirect()->route('kotobamu.index')->with([
            'success' => '正常に登録されました',
        ]);
    }

    public function update(UpdateKotobamuRequest $req, Kotobamu $kotobamu)
    {
        $param = $req->safe()->all();

        if (array_key_exists('is_open', $param)) $param["is_open"] = intval($param["is_open"]);

        $kotobamu->update(
            $param
        );

        return redirect()->back()->with([
            'success' => '正常に更新されました',
        ]);
    }

    public function destroy(Kotobamu $kotobamu)
    {
        $kotobamu->delete();
        return redirect()->route('kotobamu.index')->with([
            'success' => '正常に削除されました',
        ]);
    }
}
