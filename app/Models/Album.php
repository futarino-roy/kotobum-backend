<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id', 
        'is_sent', 
        'template'
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function body()
    {
        return $this->hasOne(Body::class, 'albums_id');
    }

    public function cover()
    {
        return $this->hasOne(Cover::class, 'albums_id');
    }
}