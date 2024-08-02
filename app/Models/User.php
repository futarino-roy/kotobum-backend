<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use App\Models\Kotobamu;
use App\Models\Torisetsu;

class User extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'line_display_name',
        'line_picture_url',
        'line_user_id',
        'line_access_token',
        'line_access_token_expired',
        'name',
        'kotobamu_id',
        'birthday',
        'pref',
        'state',
        'gender',
        'is_blocking',
        'is_admin'
    ];

    protected $casts = [
        'is_blocking' => 'boolean',
        'is_admin' => 'boolean'
    ];

    public function kotobamus(): BelongsToMany
    {
        return $this->belongsToMany(Kotobamu::class, 'applications');
    }

    // アクセサ
    /**
     * ニックネームがあればそれ。なければlineの名前
     */
    public function getNickNameAttribute()
    {
        return $this->name ?: $this->line_display_name;
    }

    public function torisetsus()
    {
        return $this->hasMany(Torisetsu::class);
    }

    // event hook
    public static function boot()
    {
        parent::boot();

        // DELETE CASCADEだけだとトリセツ画像の物理削除はしてくれないのでEloquentを使用して削除
        static::deleting(function ($user) {
            foreach ($user->torisetsus as $torisetsu) {
                $torisetsu->delete();
            }
        });
    }

    // スコープ
    public function scopeAdmins($query)
    {
        return $query->where('is_admin', true);
    }
}
