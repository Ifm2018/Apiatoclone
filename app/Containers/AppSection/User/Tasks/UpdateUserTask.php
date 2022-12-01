<?php

namespace App\Containers\AppSection\User\Tasks;

use App\Containers\AppSection\User\Data\Repositories\EloquentUserRepository;
use App\Containers\AppSection\User\Data\DTO\UserDTO;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;

class UpdateUserTask extends ParentTask
{
    public function __construct(
        protected EloquentUserRepository $repository
    ) {
    }

    /**
     * @param UserDTO $userData
     * @return UserDTO
     * @throws NotFoundException
     * @throws UpdateResourceFailedException
     */
    public function run(UserDTO $userData): UserDTO
    {
        try {
            if (is_string($userData->password)) {
                $userData->additional([
                    'password' => Hash::make($userData->password),
                ]);
            }

            return UserDTO::from($this->repository->update($userData->toArray(), $userData->id));
        } catch (ModelNotFoundException) {
            throw new NotFoundException();
        } catch (Exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
