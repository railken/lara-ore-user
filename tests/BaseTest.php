<?php

namespace Railken\LaraOre\User\Tests;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Railken\LaraCommandTest\Helper;
use Railken\LaraCommandTest\GeneratorCommandTestable;
use Illuminate\Support\Facades\Artisan;


abstract class BaseTest extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            \Railken\Laravel\Manager\ManagerServiceProvider::class,
            \Railken\LaraOre\UserServiceProvider::class,
            \Zizaco\Entrust\EntrustServiceProvider::class,
        ];
    }

    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        $dotenv = new \Dotenv\Dotenv(__DIR__.'/..', '.env');
        $dotenv->load();

        $helper = new Helper(__DIR__ . "/../var/cache");
        $command = $helper->generate(\Zizaco\Entrust\MigrationCommand::class, ['yes']);

        parent::setUp();
        
        File::cleanDirectory(database_path("migrations/"));

        $this->artisan('vendor:publish', [
            '--provider' => 'Zizaco\Entrust\EntrustServiceProvider',
            '--force' => true,
        ]);

        $this->artisan('vendor:publish', [
            '--provider' => 'Railken\LaraOre\UserServiceProvider',
            '--force' => true,
        ]);

        $helper->call($command);

        $this->artisan('migrate:fresh');
        $this->artisan('migrate');
    }
}
