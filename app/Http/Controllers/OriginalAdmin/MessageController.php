<?php

namespace App\Http\Controllers\OriginalAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Message;
use App\Http\Requests\MessageRequest;
use Illuminate\Support\Facades\File;

class MessageController extends Controller
{
    public function create(Application $application)
    {
        $messages = $application->messages;
        return view('original_admin.message.create', compact('application', 'messages'));
    }

    public function store(MessageRequest $req, Application $application)
    {
        $param = $req->safe()->all();
        if (array_key_exists("image", $req->all())) {

            // 画像をサーバーに保存する処理
            $dir = "kotobamu_message/{$application->kotobamu->id}";
            $image_path = $req->file('image')->store('public/' . $dir);

            // 画像へのパスとメッセージの内容をDBに保存する処理
            // $image_pathの先頭のpublicをstorageに変換してDBに保存
            $param["image_path"] = preg_replace("/public/", "storage", $image_path, 1);
        }

        $application->messages()->create(
            $param
        );

        return redirect()->back()->with([
            'success' => '正常に登録されました',
        ]);
    }

    public function update(MessageRequest $req, Application $application, Message $message)
    {
        $this->authorize("update", $message);

        $message = $application->messages()->findOrFail($message->id);

        $param = $req->safe()->all();

        if (array_key_exists("image", $req->all())) {
            if (File::exists($message->image_path)) {
                File::delete($message->image_path);
                $message->image_path = null;
                $message->save();
            }
            // 画像をサーバーに保存する処理
            $dir = "kotobamu_message/{$application->kotobamu->id}";
            $image_path = $req->file('image')->store('public/' . $dir);

            // 画像へのパスとメッセージの内容をDBに保存する処理
            // $image_pathの先頭のpublicをstorageに変換してDBに保存
            $param["image_path"] = preg_replace("/public/", "storage", $image_path, 1);
        }

        $message->update(
            $param
        );

        return redirect()->route('message.create', ['application' => $application])->with([
            'success' => '正常に更新されました',
        ]);
    }

    public function edit(Application $application, Message $message)
    {
        $message = $application->messages()->findOrFail($message->id);
        return view('original_admin.message.edit', compact('application', 'message'));
    }

    public function destroy(Application $application, Message $message)
    {
        $this->authorize("delete", $message);

        $message = $application->messages()->findOrFail($message->id);
        $message->delete();

        // 画像物理削除の処理はmessageモデルのイベントフックに記述

        return redirect()->route('message.create', ['application' => $application])->with([
            'success' => '正常に削除されました',
        ]);
    }
}
