<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class TemplateController extends Controller
{
    public function selectTemplate(Request $request)
    {
        $request->validate([
            'template' => 'required|in:A,B',
        ]);

        $user = $request->user();
        $user->template = $request->input('template');
        $user->save();

        return response()->json(['message' => 'Template selected successfully']);
    }
}
