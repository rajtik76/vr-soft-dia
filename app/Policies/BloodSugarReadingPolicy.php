<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\BloodSugarReading;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BloodSugarReadingPolicy
{
    use HandlesAuthorization;

    public function update(User $user, BloodSugarReading $bloodSugarReading): bool
    {
        return $this->view($user, $bloodSugarReading);
    }

    public function view(User $user, BloodSugarReading $bloodSugarReading): bool
    {
        return $user->id === $bloodSugarReading->user_id;
    }

    public function delete(User $user, BloodSugarReading $bloodSugarReading): bool
    {
        return $this->view($user, $bloodSugarReading);
    }
}
