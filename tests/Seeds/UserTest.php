<?php

namespace Railken\Amethyst\Tests\Seeds;

use Railken\Amethyst\Database\Seeds\UserSeeder;
use Railken\Amethyst\Tests\BaseTest;

class UserTest extends BaseTest
{
    public function testUsers()
    {
        $this->artisan('db:seed', ['--class' => UserSeeder::class]);
        $this->assertEquals(1, 1);
    }
}
