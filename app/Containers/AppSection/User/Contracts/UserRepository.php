<?php

namespace App\Containers\AppSection\User\Contracts;

use App\Containers\AppSection\User\Models\User;

interface UserRepository extends Repository
{
    public function createUserByCredentials(array $data): User;
}
