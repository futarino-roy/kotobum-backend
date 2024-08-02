<?php

namespace App\Policies;

use App\Models\Message;
use App\Models\OriginalAdmin;
use Illuminate\Auth\Access\Response;

class MessagePolicy
{
    public function update(OriginalAdmin $user, Message $message): bool
    {
        return is_future_message($message->id);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(OriginalAdmin $user, Message $message): bool
    {
        return is_future_message($message->id);
    }
}
