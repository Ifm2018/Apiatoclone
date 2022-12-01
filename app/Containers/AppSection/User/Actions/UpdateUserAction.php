<?php

namespace App\Containers\AppSection\User\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\User\Data\DTO\UserDTO;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\Tasks\UpdateUserTask;
use App\Containers\AppSection\User\UI\API\Requests\UpdateUserRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class UpdateUserAction extends ParentAction
{
    /**
     * @param UserDTO $dto
     * @return UserDTO
     * @throws NotFoundException
     * @throws UpdateResourceFailedException
     */
    public function run(UserDTO $dto): UserDTO
    {
//        $sanitizedData = $transporter->sanitizeInput([
//            'name',
//            'gender',
//            'birth',
//        ]);

        return app(UpdateUserTask::class)->run($dto);
//        return app(UpdateUserTask::class)->run($sanitizedData, $transporter->id);
    }
}
