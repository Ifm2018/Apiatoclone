<?php

namespace App\Containers\AppSection\User\Contracts;

use Prettus\Repository\Contracts\CacheableInterface as PrettusCacheable;
use Prettus\Repository\Contracts\RepositoryCriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

interface Repository extends RepositoryInterface, RepositoryCriteriaInterface, PrettusCacheable
{

}
