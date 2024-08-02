<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\TorisetsuContent;
use App\Models\User;
use Illuminate\Support\Facades\File;

class Torisetsu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'good_at',
        'weak_point',
        'recommendation',
        'landmine',
        'when_depressed',
        'when_sick',
        'for_making_up',
        'when_bad_mood',
        'image_url',
        'user_id',
        'illust_choice',
        'image_deleted_at',
        'image_stored_path'
    ];

    protected $casts = [
        'good_at' => TorisetsuContent::class,
        'weak_point' => TorisetsuContent::class,
        'recommendation' => TorisetsuContent::class,
        'landmine' => TorisetsuContent::class,
        'when_depressed' => TorisetsuContent::class,
        'when_sick' => TorisetsuContent::class,
        'for_making_up' => TorisetsuContent::class,
        'when_bad_mood' => TorisetsuContent::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // event hook
    public static function boot()
    {
        parent::boot();
        static::deleting(function ($torisetsu) {
            // 画像があれば物理削除
            if (File::exists($torisetsu->image_stored_path)) {
                File::delete($torisetsu->image_stored_path);
            }
        });
    }
}
