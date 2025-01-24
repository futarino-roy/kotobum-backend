<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'Auser_id',
        'Buser_id',
    ];

    public function Auser()
    {
        return $this->hasOne(User::class, 'id','Auser_id')->where('template', 'A');
    }

    public function Buser()
    {
        return $this->hasOne(User::class, 'id','Buser_id')->where('template', 'B');
    }
}
