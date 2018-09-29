<?php

namespace Railken\Amethyst\Providers;

use Railken\Amethyst\Common\CommonServiceProvider;
use Railken\Amethyst\Console\Commands\UserInstallCommand;
use Railken\Amethyst\Console\Commands\UserRefreshTokenCommand;

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
