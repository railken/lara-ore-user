<?php

namespace Railken\LaraOre;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Railken\LaraOre\Api\Support\Router;
use Railken\LaraOre\Console\Commands\UserInstallCommand;
use Railken\LaraOre\Console\Commands\UserRefreshTokenCommand;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/ore.user.php' => config_path('ore.user.php'),
        ], 'config');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        config(['ore.managers' => array_merge(Config::get('ore.managers', []), [
            \Railken\LaraOre\User\UserManager::class,
        ])]);

        $this->commands([UserInstallCommand::class, UserRefreshTokenCommand::class]);
        $this->loadRoutes();
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->register(\Railken\Laravel\Manager\ManagerServiceProvider::class);
        $this->app->register(\Railken\LaraOre\ApiServiceProvider::class);
        $this->mergeConfigFrom(__DIR__.'/../config/ore.user.php', 'ore.user');
    }

    /**
     * Load routes.
     */
    public function loadRoutes()
    {
        $config = Config::get('ore.user.http.admin');

        if (Arr::get($config, 'enabled')) {
            Router::group('admin', Arr::get($config, 'router'), function ($router) use ($config) {
                $controller = Arr::get($config, 'controller');

                $router->get('/', ['uses' => $controller.'@index']);
                $router->post('/', ['uses' => $controller.'@create']);
                $router->put('/{id}', ['uses' => $controller.'@update']);
                $router->delete('/{id}', ['uses' => $controller.'@remove']);
                $router->get('/{id}', ['uses' => $controller.'@show']);
            });
        }
    }
}
