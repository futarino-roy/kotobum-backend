<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'login_id',
        'password',
        'template',
        'format',
        'partner_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    /* protected $casts = [
        'email_verified_at' => 'datetime',
    ]; */

    public function Album()
    {
        return $this->hasOne(Album::class);
    }

    // パートナーリレーション (自己リレーション)
    public function partner()
    {
        return $this->hasOne(User::class, 'partner_id','id');
    }

    // 逆方向のリレーション (パートナーから見た自分)
    public function partnerBack()
    {
        return $this->hasOne(User::class, 'id', 'partner_id');
    }

    public function partnerCover()
    {
        return $this->partner()->with('Album.cover');
    }

    //　パートナーを設定する
    public function setPartner($partnerId)
    {
        DB::transaction(function () use ($partnerId) {
            $partner = User::findOrFail($partnerId);
            
             // A面B面が異なる場合にのみリレーションを設定
             if ($this->template !== $partner->template) {
                // 現在のパートナーを解除
                if ($this->partner) {
                    $this->partner->update(['partner_id' => null]);
                }

                // 新しいパートナーを設定
                $this->update(['partner_id' => $partnerId]);

                // パートナーにも自分を設定
                $partner->update(['partner_id' => $this->id]);
            } else {
                throw new \Exception('A面B面が異なる場合にのみリレーションを設定できます。');
            }
        });
    }
    
    // パートナーを付け替える
    public function switchPartner($newPartnerId)
    {
        DB::transaction(function () use ($newPartnerId) {
            $newPartner = User::findOrFail($newPartnerId);
            dd($newPartnerId);

            // A面B面が異なる場合にのみリレーションを設定
            if ($this->template !== $newPartner->template) {
                // 現在のパートナーを解除
                if ($this->partner) {
                    $this->partner->update(['partner_id' => null]);
                }

                // 新しいパートナーを設定
                $this->update(['partner_id' => $newPartnerId]);
                $newPartner->update(['partner_id' => $this->id]);
            } else {
                throw new \Exception('A面B面が異なる場合にのみリレーションを設定できます。');
            }
        });
    }

    // パートナーを解除
    public function detachPartner()
    {
        DB::transaction(function () {
            // 現在のパートナーを解除
            if ($this->partner) {
                $this->partner->update(['partner_id' => null]);
            }

            // 自分のpartner_idを解除
            $this->update(['partner_id' => null]);
        });
    }
}
