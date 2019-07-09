<?php

namespace Amethyst\Tests\Seeds;

use Amethyst\Database\Seeds\UserSeeder;
use Amethyst\Tests\BaseTest;

class UserTest extends BaseTest
{
    public function testUsers()
    {
        $this->artisan('db:seed', ['--class' => UserSeeder::class]);
        $this->assertEquals(1, 1);
    }
}
