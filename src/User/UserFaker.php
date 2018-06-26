<?php

namespace Railken\LaraOre\User;

use Railken\Bag;
use Faker\Factory;

class UserFaker
{
    /**
     * @return array
     */
    public static function make()
    {
        $faker = Factory::create();
        
        $bag = new Bag();
        $bag->set('name', $faker->name);
        $bag->set('email', $faker->email);
        $bag->set('password', $faker->password);
        // $bag->set('role', 'user');
        $bag->set('enabled', 1);

        return $bag;
    }
}
