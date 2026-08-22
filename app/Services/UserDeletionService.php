<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserDeletionService
{
    /**
     * Delete a user and records whose older foreign keys do not cascade.
     */
    public function delete(User $user): void
    {
        DB::transaction(function () use ($user): void {
            $user->detailuser()->delete();
            $user->submitTugas()->delete();
            $user->submitPresensi()->delete();
            $user->tokens()->delete();
            $user->delete();
        });
    }
}
