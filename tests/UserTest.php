<?php

namespace Railken\LaraOre\User\Tests;

use Railken\Bag;
use Railken\LaraOre\User\UserManager;

/**
 * Testing users
 * Attributes
 */
class UserTest extends BaseTest
{
    use Traits\CommonTrait;
    
    /**
     * Retrieve basic url.
     *
     * @return \Railken\Laravel\Manager\Contracts\ManagerContract
     */
    public function getManager()
    {
        return new UserManager();
    }

    /**
     * Retrieve correct bag of parameters.
     *
     * @return Bag
     */
    public function getParameters()
    {
        $bag = new bag();
        $bag->set('name', 'Mario');
        $bag->set('password', str_random(16));
        $bag->set('email', 'user@test.net');
        return $bag;
    }

    /** @test */
    public function it_will_work()
    {
        $this->commonTest($this->getManager(), $this->getParameters());
    }
}
