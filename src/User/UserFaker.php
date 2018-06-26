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
        $bag->set('password', str_random(16));
        // $bag->set('role', 'user');
        $bag->set('notes', $faker->realText);
        $bag->set('enabled', 1);

        return $bag;
    }
}
