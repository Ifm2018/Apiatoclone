<?php

namespace App\Containers\AppSection\User\Providers;

use App\Containers\AppSection\User\Contracts\UserRepository;
use App\Containers\AppSection\User\Data\Repositories\EloquentUserRepository;
use App\Ship\Parents\Providers\MainServiceProvider as ParentMainServiceProvider;

/**
 * Class MainServiceProvider.
 *
 * The Main Service Provider of this container, it will be automatically registered in the framework.
 */
class MainServiceProvider extends ParentMainServiceProvider
{
    /**
     * Container Service Providers.
     */
    public array $serviceProviders = [
        // InternalServiceProviderExample::class,
        // ...
    ];

    /**
     * Container Aliases
     */
    public array $aliases = [

    ];

    /**
     * Register anything in the container.
     */
    public function register(): void
    {
        parent::register();

        $this->app->bind(UserRepository::class, EloquentUserRepository::class);
    }
}
