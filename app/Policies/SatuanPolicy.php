<?php

namespace App\Policies;

use App\Models\User;
use App\Models\satuanModel;
use Illuminate\Auth\Access\Response;

class SatuanPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->id_hak == 1 || $user->id_hak == 2;
    }

    public function store(User $user): bool {
        return $user->id_hak == 1 || $user->id_hak == 2;
    }


    public function view(User $user, satuanModel $satuanModel): bool
    {
        return $user->id_hak == 1 || $user->id_hak == 2;
    }

    public function update(User $user, satuanModel $satuanModel): bool
    {
        return $user->id_hak == 1 || $user->id_hak == 2;
    }

    public function delete(User $user, satuanModel $satuanModel): bool
    {
        return $user->id_hak == 1 || $user->id_hak == 2;
    }
}
