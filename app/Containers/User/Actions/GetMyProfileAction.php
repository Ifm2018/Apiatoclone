<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Exceptions\UserNotFoundException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class GetMyProfileAction extends Action
{
    public function run(Request $request)
    {
        $user = $this->call('Authentication@GetAuthenticatedUserTask');

        if (!$user) {
            throw new UserNotFoundException();
        }

        return $user;
    }
}
