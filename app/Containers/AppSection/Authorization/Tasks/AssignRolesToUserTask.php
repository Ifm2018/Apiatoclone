<?php

namespace App\Containers\AppSection\Authorization\Tasks;

use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Contracts\Auth\Authenticatable;

class AssignRolesToUserTask extends Task
{
    /**
     * @param User $user
     * @param Role[] $roles
     * @return Authenticatable
     */
    public function run(User $user, array $roles): Authenticatable
    {
        return $user->assignRole($roles);
    }
}