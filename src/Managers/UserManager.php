<?php

namespace Amethyst\Managers;

use Amethyst\Common\ConfigurableManager;
use Railken\Lem\Manager;

/**
 * @method \Amethyst\Models\User                 newEntity()
 * @method \Amethyst\Schemas\UserSchema          getSchema()
 * @method \Amethyst\Repositories\UserRepository getRepository()
 * @method \Amethyst\Serializers\UserSerializer  getSerializer()
 * @method \Amethyst\Validators\UserValidator    getValidator()
 * @method \Amethyst\Authorizers\UserAuthorizer  getAuthorizer()
 */
class UserManager extends Manager
{
    use ConfigurableManager;

    /**
     * @var string
     */
    protected $config = 'amethyst.user.data.user';
}
