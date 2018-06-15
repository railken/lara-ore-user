<?php

namespace Railken\LaraOre\User\Tests;

use Railken\LaraOre\Support\Testing\ManagerTestableTrait;
use Railken\LaraOre\User\UserManager;

class ManagerTest extends BaseTest
{
    use ManagerTestableTrait;
    
    /**
     * Retrieve basic manager.
     *
     * @return \Railken\Laravel\Manager\Contracts\ManagerContract
     */
    public function getManager()
    {
        return new UserManager();
    }

    /** @test */
    public function it_will_work()
    {
        $this->commonTest($this->getManager(), $this->getParameters());
    }
}
