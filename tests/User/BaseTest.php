<?php

namespace Railken\LaraOre\Tests\User;

abstract class BaseTest extends \Orchestra\Testbench\TestCase
{
    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        $dotenv = new \Dotenv\Dotenv(__DIR__.'/../..', '.env');
        $dotenv->load();

        parent::setUp();

        $this->artisan('migrate:fresh');
        $this->artisan('lara-ore:user:install');
        $this->artisan('migrate');
    }

    protected function getPackageProviders($app)
    {
        return [
            \Railken\LaraOre\UserServiceProvider::class,
        ];
    }
}