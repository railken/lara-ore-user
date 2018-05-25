<?php

namespace Railken\LaraOre;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class UserServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/ore.user.php' => config_path('ore.user.php'),
        ], 'config');

        if (!class_exists('CreateUsersTable')) {
            $this->publishes([
                __DIR__.'/../database/migrations/create_users_table.php.stub' => database_path('migrations/'.date('Y_m_d_His', time()).'_create_users_table.php'),
            ], 'migrations');
        }
        

        config(['entrust.role' => "Railken\LaraOre\Role\Role"]);
        config(['entrust.permission' => "Railken\LaraOre\Permission\Permission"]);
        config(['entrust.user' => config('ore.user.entity')]);
        config(['auth.providers.users.model' => config('ore.user.entity')]);

    }
}
