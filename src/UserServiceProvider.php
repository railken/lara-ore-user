<?php

namespace Railken\LaraOre;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Railken\LaraOre\Api\Support\Router;
use Railken\LaraOre\Console\Commands\UserInstallCommand;
use Railken\LaraOre\Permission\Console\Commands\FlushPermissionsCommand;
use Railken\LaraOre\Console\Commands\UserRefreshTokenCommand;

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

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        config(['entrust.role' => "Railken\LaraOre\Permission\Role"]);
        config(['entrust.permission' => "Railken\LaraOre\Permission\Permission"]);
        config(['entrust.user' => Config::get('ore.user.entity')]);


        $this->commands([FlushPermissionsCommand::class, UserInstallCommand::class, UserRefreshTokenCommand::class]);
        $this->loadRoutes();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(\Railken\Laravel\Manager\ManagerServiceProvider::class);
        $this->app->register(\Railken\LaraOre\ApiServiceProvider::class);
        $this->app->register(\Zizaco\Entrust\EntrustServiceProvider::class);
        $this->mergeConfigFrom(__DIR__.'/../config/ore.user.php', 'ore.user');
    }

    /**
     * Load routes.
     */
    public function loadRoutes()
    {
        Router::group(Config::get('ore.user.http.router'), function ($router) {
            $controller = Config::get('ore.user.http.controller');
            
            $router->get('/', ['uses' => $controller . '@index']);
            $router->post('/', ['uses' => $controller . '@create']);
            $router->put('/{id}', ['uses' => $controller . '@update']);
            $router->delete('/{id}', ['uses' => $controller . '@remove']);
            $router->get('/{id}', ['uses' => $controller . '@show']);
        });
    }
}
