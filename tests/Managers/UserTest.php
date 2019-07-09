<?php

namespace Amethyst\Tests\Managers;

use Amethyst\Fakers\UserFaker;
use Amethyst\Managers\UserManager;
use Amethyst\Tests\BaseTest;
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
