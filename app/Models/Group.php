<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'format',
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

    // 修正必要あり
    public function setAuser(User $user)
    {
        if ($user->template !== 'A') {
            throw new \Exception('User template must be A');
        }
        $this->Auser_id = $user->id;
        $this->save();
        
        $user->group_id = $this->id;
        $user->save();
    }

    // 修正必要あり
    public function setBuser(User $user)
    {
        if ($user->template !== 'B') {
            throw new \Exception('User template must be B');
        }
        $this->Buser_id = $user->id;
        $this->save();
        
        $user->group_id = $this->id;
        $user->save();
    }

    public function deleteuser(User $user)
    {
        if ($this->Auser_id === $user->id) {
            $this->Auser_id = null;
        }
        if ($this->Buser_id === $user->id) {
            $this->Buser_id = null;
        }
        $this->save();
        
        // 修正必要あり
        $user->group_id = null;
        $user->save();
    }
}
