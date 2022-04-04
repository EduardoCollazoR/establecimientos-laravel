<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Establecimiento;
use Illuminate\Auth\Access\HandlesAuthorization;

class EstablecimientoPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Establecimiento $establecimiento)
    {
        return $user->id === $establecimiento->user_id;
    }

    public function delete(User $user, Establecimiento $establecimiento)
    {
        return $user->id === $establecimiento->user_id;
    }
}
