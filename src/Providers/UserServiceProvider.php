<?php

namespace Amethyst\Providers;

use Amethyst\Console\Commands\UserInstallCommand;
use Amethyst\Core\Providers\CommonServiceProvider;

class UserServiceProvider extends CommonServiceProvider
{
    /**
     * @inherit
     */
    public function boot(): void
    {
        $this->commands([UserInstallCommand::class]);

        parent::boot();
    }
}
