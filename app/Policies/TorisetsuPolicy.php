<?php

namespace App\Policies;

use App\Models\Torisetsu;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TorisetsuPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // ニックネームが未設定（つまり会員登録まだしてない）であればトリセツは作らせない
        return isset($user->name);
    }
}
