<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 

class UserController extends Controller
{
    public function show(Request $request)
    {
        return response()->json($request->user());
    }
}
