<?php

namespace App\Containers\AppSection\Authentication\Tasks;

use App\Containers\AppSection\User\Contracts\UserRepository;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;

class CreateUserByCredentialsTask extends ParentTask
{
    public function __construct(
        protected UserRepository $repository
    ) {
    }

    /**
     * @param array $data
     * @return User
     * @throws CreateResourceFailedException
     */
    public function run(array $data): User
    {
        try {
            return $this->repository->createUserByCredentials($data);
        } catch (Exception) {
            throw new CreateResourceFailedException();
        }
    }
}
