<?php

namespace App\Policies;

use App\Models\Recitation;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RecitationPolicy
{
    public function viewOrModify(User $user, Recitation $recitation): Response
    {
        return $user->id === $recitation->user_id ? Response::allow() : Response::denyAsNotFound();
    }
}
