<?php

namespace App\Policies;

use App\Models\Medicine;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MedicinePolicy
{
    use HandlesAuthorization;

    public function view(User $user, Medicine $medicine): bool
    {
        return $user->id === $medicine->user_id;
    }

    public function update(User $user, Medicine $medicine): bool
    {
        return $this->view($user, $medicine);
    }

    public function delete(User $user, Medicine $medicine): bool
    {
        return $this->view($user, $medicine);
    }
}
