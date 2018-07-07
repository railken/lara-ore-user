<?php

namespace Railken\LaraOre\User;

use Faker\Factory;
use Railken\Bag;
use Railken\Laravel\Manager\BaseFaker;

class UserFaker extends BaseFaker
{
    /**
     * @var string
     */
    protected $manager = UserManager::class;

    /**
     * @return \Railken\Bag
     */
    public function parameters()
    {
        $faker = Factory::create();

        $bag = new Bag();
        $bag->set('name', $faker->name);
        $bag->set('email', $faker->email);
        $bag->set('password', str_random(16));
        // $bag->set('role', 'user');
        $bag->set('notes', $faker->realText);
        $bag->set('enabled', 1);

        return $bag;
    }
}
