<?php

namespace Railken\LaraOre;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use Laravel\Passport\RouteRegistrar;
use Railken\LaraOre\Api\Support\Router;
use Railken\LaraOre\Console\Commands\UserInstallCommand;
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

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        config(['entrust.role' => "Railken\LaraOre\Permission\Role"]);
        config(['entrust.permission' => "Railken\LaraOre\Permission\Permission"]);
        config(['entrust.user' => config('ore.user.entity')]);

        config(['auth.guards.api.driver' => 'passport']);
        config(['auth.guards.api.provider' => 'users']);
        config(['auth.providers.users.driver' => 'eloquent']);
        config(['auth.providers.users.model' => \Railken\LaraOre\User\User::class]);

        $this->commands([FlushPermissionsCommand::class, UserInstallCommand::class]);
        $this->loadRoutes();

        $callback = function ($router) {
            $router->all();
        };

        $options = array_merge([
            'namespace' => '\Laravel\Passport\Http\Controllers',
            'prefix'    => 'api/v1/oauth',
        ], []);

        Route::group($options, function ($router) use ($callback) {
            $callback(new RouteRegistrar($router));
        });

        Passport::tokensExpireIn(now()->addDays(15));
        Passport::refreshTokensExpireIn(now()->addDays(30));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(\Laravel\Passport\PassportServiceProvider::class);
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
        Route::group(array_merge(Config::get('ore.api.router'), [
            'namespace' => 'Railken\LaraOre\Http\Controllers',
        ]), function ($router) {
            $router->post('/sign-up', ['uses' => 'RegistrationController@index']);
            $router->post('/confirm-email', ['uses' => 'RegistrationController@confirmEmail']);
            $router->post('/request-confirm-email', ['uses' => 'RegistrationController@requestConfirmEmail']);

            $router->post('/sign-in', ['uses' => 'SignInController@signIn']);
            $router->post('/oauth/{name}/access_token', ['uses' => 'SignInController@accessToken']);
            $router->post('/oauth/{name}/exchange_token', ['uses' => 'SignInController@exchangeToken']);

            $router->group(['middleware' => ['auth:api']], function () {
                Route::get('/user', ['uses' => 'UserController@index']);
            });
        });

        Router::group(array_merge(Config::get('ore.user.router'), [
            'namespace' => 'Railken\LaraOre\Http\Controllers',
        ]), function ($router) {
            $router->get('/', ['uses' => 'UsersController@index']);
            $router->post('/', ['uses' => 'UsersController@create']);
            $router->put('/{id}', ['uses' => 'UsersController@update']);
            $router->delete('/{id}', ['uses' => 'UsersController@remove']);
            $router->get('/{id}', ['uses' => 'UsersController@show']);
        });
    }
}
