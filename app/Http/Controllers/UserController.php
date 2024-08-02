<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;

class UserController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        $user = $user->only([
            "nick_name",
            "gender",
            "birthday",
            "pref",
            "state"
        ]);

        return response()->json([
            "data" => $user
        ]);
    }

    public function update(UpdateUserRequest $req)
    {
        $user = auth()->user();
        $param = $req->safe()->except('accept');
        if ($user->fill($param)->save()) {
            return response()->json([
                "data" => ["result" => "ok"]
            ]);
        }

        return response()->json([
            "data" => ["result" => "ng", "message" => "failed save"]
        ]);
    }
}
