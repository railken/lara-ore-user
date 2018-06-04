<?php

namespace Railken\LaraOre\User\Tests;

use Railken\Bag;
use Railken\LaraOre\Support\Testing\ManagerTestableTrait;
use Railken\LaraOre\User\UserManager;

class ManagerTest extends BaseTest
{
    use ManagerTestableTrait;
    
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
        $bag = new Bag();
        $bag->set('name', 'Mario');
        $bag->set('password', str_random(16));
        $bag->set('email', 'user@test.net');
        $bag->set('enabled', 1);
        return $bag;
    }

    /** @test */
    public function it_will_work()
    {
        $this->commonTest($this->getManager(), $this->getParameters());
    }
}
