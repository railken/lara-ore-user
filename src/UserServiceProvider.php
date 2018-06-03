<?php

namespace Railken\LaraOre;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Railken\LaraOre\Permission\Console\Commands\FlushPermissionsCommand;

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
                __DIR__.'/../database/migrations/create_users_table.php.stub' => database_path('migrations/'.(new \DateTime())->format("Y_m_d_His.u").'_create_users_table.php'),
            ], 'migrations');
        }

        if (!class_exists('EntrustSetupTables')) {
            $this->publishes([
                __DIR__.'/../database/migrations/entrust_setup_tables.php.stub' => database_path('migrations/'.(new \DateTime())->format("Y_m_d_His.u").'_entrust_setup_tables.php'),
            ], 'migrations');
        }

        config(['entrust.role' => "Railken\LaraOre\Permission\Role"]);
        config(['entrust.permission' => "Railken\LaraOre\Permission\Permission"]);
        config(['entrust.user' => config('ore.user.entity')]);
        config(['auth.providers.users.model' => config('ore.user.entity')]);

        $this->commands([FlushPermissionsCommand::class]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(\Railken\Laravel\Manager\ManagerServiceProvider::class);
        $this->app->register(\Zizaco\Entrust\EntrustServiceProvider::class);
        $this->mergeConfigFrom(__DIR__.'/../config/ore.user.php', 'ore.user');
    }
}
