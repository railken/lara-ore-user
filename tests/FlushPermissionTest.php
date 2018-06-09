<?php

namespace Railken\LaraOre\User\Tests;

class FlushPermissionTest extends BaseTest
{
    /** @test */
    public function it_will_flush_permission()
    {
        $this->assertEquals(1, $this->artisan('lara-ore:permission:flush'));
    }
}
