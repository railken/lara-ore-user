<?php

namespace Amethyst\Providers;

use Amethyst\Core\Providers\CommonServiceProvider;
use Amethyst\Console\Commands\UserInstallCommand;
use Amethyst\Console\Commands\UserRefreshTokenCommand;

class UserServiceProvider extends CommonServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        $this->commands([UserInstallCommand::class, UserRefreshTokenCommand::class]);

        parent::boot();
    }
}
