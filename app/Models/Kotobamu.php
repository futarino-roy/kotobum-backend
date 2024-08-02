<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Application;

class Kotobamu extends Model
{
    use HasFactory;

    protected $fillable = [
        'keyword',
        'done_on',
        'is_open'
    ];

    protected $casts = [
        'is_open' => 'boolean',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'applications');
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function getAllMessagesAttribute()
    {
        $ids = $this->applications->pluck('id');
        return Message::whereIn("application_id", $ids)->get();
    }

    // event hook
    public static function boot()
    {
        parent::boot();

        // DELETE CASCADEだけだとコトバム画像の物理削除はしてくれないのでEloquentを使用して削除
        static::deleting(function ($kotobamu) {
            foreach ($kotobamu->all_messages as $message) {
                $message->delete();
            }
        });
    }
}
