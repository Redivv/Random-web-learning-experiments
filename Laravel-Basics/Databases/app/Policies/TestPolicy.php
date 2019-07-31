<?php

namespace App\Policies;

use App\User;
use App\Test;
use Illuminate\Auth\Access\HandlesAuthorization;

class TestPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the test.
     *
     * @param  \App\User  $user
     * @param  \App\Test  $test
     * @return mixed
     */
    public function update(User $user, Test $test)
    {
        return $test->id === $user->id;         // pozwala na akcje jeśli warunek jest spełniony
    }
}
