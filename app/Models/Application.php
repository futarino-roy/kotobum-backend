<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Kotobamu;
use App\Models\Message;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kotobamu_id',
        'is_approved',
        'input_keyword',
        'memo'
    ];

    protected $casts = [
        'is_approved' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kotobamu()
    {
        return $this->belongsTo(Kotobamu::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
