<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        // ミドルウェアを適用して管理者のみがアクセスできるようにします
        $this->middleware('auth:admin');
    }

    public function index()
    {
        // ログインしている管理者を取得
        $admin = Auth::guard('admin')->user();
        $users = User::all();
        
        // ダッシュボードビューを返す
        return view('admin.dashboard', compact('admin','users'));
    }
}
