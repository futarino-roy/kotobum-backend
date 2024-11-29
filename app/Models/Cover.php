<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cover extends Model
{
    use HasFactory;

    protected $fillable = [
        'albums_id', 
        'textData',
        'imageData',   
        'colors'
    ];

    public function album()
    {
        return $this->belongsTo(Album::class, 'albums_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::updated(function ($cover) {
            // 対象カラムが変更された場合のみ処理を実行
            if ($cover->isDirty('status')) {
                $album = $cover->album;
                $user = $album->user; // カバーが紐づいているユーザーを取得

                // パートナーが存在し、そのパートナーのアルバムにカバーがある場合
                if ($user && $user->partner && $user->partner->albums()->exists()) {
                    // パートナーのアルバムのカバーを更新
                    foreach ($user->partner->albums as $partnerAlbum) {
                        if ($partnerAlbum->cover) {
                            // パートナーのカバーのstatusを更新
                            $partnerAlbum->cover->update(['status' => $cover->status]);
                        }
                 }
             }
            }
        });
    }
}
