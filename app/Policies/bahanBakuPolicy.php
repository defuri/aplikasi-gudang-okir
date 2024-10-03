<?php

namespace App\Policies;

use App\Models\User;
use App\Models\bahanBakuModel;
use Illuminate\Auth\Access\Response;

class bahanBakuPolicy
{
    /**
     * Determine whether the user can view any models.
     */

    public function viewAny(User $user): bool
    {
        return $user->id_hak == 1 || $user->id_hak == 2;
    }

    public function view(User $user, bahanBakuModel $bahanBakuModel): bool
    {
        return $user->id_hak == 1 || $user->id_hak == 2;
    }

    public function update(User $user, bahanBakuModel $bahanBakuModel): bool
    {
        return $user->id_hak == 1 || $user->id_hak == 2;
    }

    public function delete(User $user, bahanBakuModel $bahanBakuModel): bool
    {
        return $user->id_hak == 1 || $user->id_hak == 2;
    }
}
