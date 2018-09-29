<?php

namespace Railken\Amethyst\Tests\Managers;

use Railken\Amethyst\Fakers\UserFaker;
use Railken\Amethyst\Managers\UserManager;
use Railken\Amethyst\Tests\BaseTest;
use Railken\Lem\Support\Testing\TestableBaseTrait;

class UserTest extends BaseTest
{
    use TestableBaseTrait;

    /**
     * Manager class.
     *
     * @var string
     */
    protected $manager = UserManager::class;

    /**
     * Faker class.
     *
     * @var string
     */
    protected $faker = UserFaker::class;
}
