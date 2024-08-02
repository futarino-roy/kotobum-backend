<?php

namespace App\Notifications;

use App\Models\User;

interface LineMessageInterface
{
    public function getLineMessage(User $notifiable);

    public function reply();
}
