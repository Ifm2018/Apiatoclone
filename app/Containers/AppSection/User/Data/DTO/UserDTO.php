<?php

namespace App\Containers\AppSection\User\Data\DTO;

use Apiato\Core\Traits\HasResourceKeyTrait;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Vinkla\Hashids\Facades\Hashids;

class UserDTO extends Data
{
    use HasResourceKeyTrait;

    protected string $resourceKey = 'User';

    public function __construct(
        public string|Optional $email,
        public string|Optional $password,
        public ?int $id = null,
        public ?string $name = null,
        public ?string $gender = null,
        public ?Carbon $birth = null,
        public ?Carbon $email_verified_at = null,
        public ?Carbon $created_at = null,
        public ?Carbon $updated_at = null,
    ) {
    }

    public function getHashedKey(): ?string
    {
        return $this->id ? Hashids::encode($this->id) : null;
    }
}
