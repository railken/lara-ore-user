<?php

namespace Railken\LaraOre\User\Tests;

use Railken\LaraOre\Support\Testing\ManagerTestableTrait;
use Railken\LaraOre\User\UserManager;
use Railken\LaraOre\User\UserFaker;

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
        $this->commonTest($this->getManager(), UserFaker::make());
    }

    /** *@test */
    public function email()
    {
        $parameters = UserFaker::make();

        $this->getManager()->create($parameters);
        $resource = $this->getManager()->getRepository()->findOneByEmail($parameters->email);

        $this->assertEquals($parameters->email, $resource->email);
    }
}
