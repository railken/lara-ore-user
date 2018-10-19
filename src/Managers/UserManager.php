<?php

namespace Railken\Amethyst\Managers;

use Railken\Amethyst\Common\ConfigurableManager;
use Railken\Lem\Manager;

class UserManager extends Manager
{
    use ConfigurableManager;

    /**
     * @var string
     */
    protected $config = 'amethyst.user.data.user';
}
