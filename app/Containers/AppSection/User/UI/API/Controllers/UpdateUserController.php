<?php

namespace App\Containers\AppSection\User\UI\API\Controllers;

use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\User\Actions\UpdateUserAction;
use App\Containers\AppSection\User\Data\DTO\UserDTO;
use App\Containers\AppSection\User\UI\API\Requests\UpdateUserRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Controllers\ApiController;

class UpdateUserController extends ApiController
{
    public function __construct(
        private readonly UpdateUserAction $action
    ) {
    }

    /**
     * @throws InvalidTransformerException
     * @throws NotFoundException
     * @throws UpdateResourceFailedException
     */
    public function __invoke(UpdateUserRequest $request): array
    {
        $user = $this->action->run(UserDTO::from($request));

        return $this->transform($user, UserTransformer::class);
    }
}
