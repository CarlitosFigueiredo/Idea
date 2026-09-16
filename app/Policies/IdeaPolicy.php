<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Idea;
use App\Models\User;

class IdeaPolicy
{
    public function workWith(User $user, Idea $idea): bool
    {
        return $idea->user->is($user); // The idea user is the current user
    }
}
