<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    // マスアサインメント可能な属性
    protected $fillable = [
        'email',
        'password',
    ];

    // パスワードやトークンなど、隠す属性
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // 型変換
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // 管理者ユーザーとしての追加のメソッドや関係をここに追加できます
}
