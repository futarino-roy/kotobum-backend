<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Application;
use Illuminate\Support\Facades\File;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'audio_url',
        'image_path',
        'content',
        'send_at',
        'is_sent',
    ];

    protected $casts = [
        'is_sent' => 'boolean',
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }


    // event hook
    public static function boot()
    {
        parent::boot();
        static::deleting(function ($message) {
            // 画像があれば物理削除
            if (File::exists($message->image_path)) {
                File::delete($message->image_path);
            }
        });
    }
}
