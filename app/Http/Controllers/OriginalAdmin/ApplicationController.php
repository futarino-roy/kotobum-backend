<?php

namespace App\Http\Controllers\OriginalAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\User;
use App\Http\Requests\UpdateApplicationRequest;
use App\Jobs\KotobamuApply;
use App\Models\Kotobamu;
use App\Traits\LineApiCallable;
use App\Services\UtilService;

class ApplicationController extends Controller
{
    use LineApiCallable;

    public function update(UpdateApplicationRequest $req, Application $application)
    {
        $param = $req->safe()->all();

        if (array_key_exists('is_approved', $param)) {
            if ($req->is_approved === 'null') {
                $param['is_approved'] = null;
            } else {
                $param['is_approved'] = intval($req->is_approved);
            }
        }
        $application->fill($param);
        $application->save();

        return redirect()->back()->with([
            'success' => '正常に更新されました',
        ]);
    }

    public function destroy(Application $application)
    {
        $application->delete();
        return redirect()->back()->with([
            'success' => '正常に削除されました',
        ]);
    }

    public function denials()
    {
        $denials = Application::where('is_approved', 0)->get();

        return view('original_admin.application.denials', compact('denials'));
    }

    public function store(Request $req)
    {
        $all = $req->all();
        $user = User::find($all["user_id"]);
        $kotobamu = Kotobamu::find($all["kotobamu_id"]);
        UtilService::CreateKotobamuApplication($user, $kotobamu, null, true);

        return redirect()->back()->with([
            'success' => '正常に登録されました',
        ]);
    }
}
