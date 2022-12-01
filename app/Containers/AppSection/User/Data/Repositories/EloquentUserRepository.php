<?php

namespace App\Containers\AppSection\User\Data\Repositories;

use App\Containers\AppSection\User\Contracts\UserRepository;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Repositories\Repository as ParentRepository;
use Illuminate\Support\Facades\Hash;
use Prettus\Validator\Exceptions\ValidatorException;

class EloquentUserRepository extends ParentRepository implements UserRepository
{
    protected $fieldSearchable = [
        'name' => 'like',
        'id' => '=',
        'email' => '=',
        'email_verified_at' => '=',
        'created_at' => 'like',
    ];

    public function model(): string
    {
        return config('auth.providers.users.model');
    }

    /**
     * @param array $data
     * @return User
     * @throws ValidatorException
     */
    public function createUserByCredentials(array $data): User
    {
        $data['password'] = Hash::make($data['password']);

        return parent::create($data);
    }
}
