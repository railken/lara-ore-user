<?php

namespace Railken\LaraOre\User\Tests;

use Railken\LaraOre\Support\Testing\ApiTestableTrait;
use Illuminate\Support\Facades\Config;
use Railken\Bag;
use Railken\LaraOre\User\UserFaker;

class ApiTest extends BaseTest
{
    use ApiTestableTrait;

    /**
     * Retrieve basic url.
     *
     * @return string
     */
    public function getBaseUrl()
    {
        return Config::get('ore.api.router.prefix').Config::get('ore.user.http.router.prefix');
    }

    /**
     * Test common requests.
     *
     * @return void
     */
    public function testSuccessCommon()
    {
        $this->signIn();
        $this->commonTest($this->getBaseUrl(), UserFaker::make());
    }
}
