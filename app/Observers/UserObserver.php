<?php

namespace App\Observers;

use App\Models\User;
use App\Notifications\WelcomeUserEmailNotification;

class UserObserver
{
    public function created(User $user)
    {
        $user->notify(new WelcomeUserEmailNotification());
    }
}
