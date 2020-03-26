<?php

namespace Amethyst\Fakers;

use Faker\Factory;
use Railken\Bag;
use Railken\Lem\Faker;

class UserFaker extends Faker
{
    /**
     * @return \Railken\Bag<object>
     */
    public function parameters()
    {
        $faker = Factory::create();

        $bag = new Bag();
        $bag->set('name', $faker->name);
        $bag->set('email', $faker->email);
        $bag->set('password', str_random(16));

        return $bag;
    }
}
