<?php

namespace App\Containers\AppSection\Authorization\UI\API\Controllers;

use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Authorization\Actions\SyncUserRolesAction;
use App\Containers\AppSection\Authorization\UI\API\Requests\SyncUserRolesRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Controllers\ApiController;

class SyncUserRolesController extends ApiController
{
    /**
     * @throws NotFoundException
     * @throws InvalidTransformerException
     */
    public function syncUserRoles(SyncUserRolesRequest $request): array
    {
        $user = app(SyncUserRolesAction::class)->run($request);
        return $this->transform($user, UserTransformer::class);
    }
}