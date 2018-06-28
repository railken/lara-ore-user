<?php

namespace Railken\LaraOre\User;

use DateTime;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Railken\Bag;
use Railken\Laravel\Manager\Contracts\AgentContract;
use Railken\Laravel\Manager\Contracts\EntityContract;
use Railken\Laravel\Manager\ModelManager;
use Railken\Laravel\Manager\ParameterBag;
use Railken\Laravel\Manager\ResultAction;
use Railken\Laravel\Manager\Tokens;
use Illuminate\Support\Facades\Config;

class UserManager extends ModelManager
{
    /**
     * Class name entity.
     *
     * @var string
     */
    public $entity;

    /**
     * Attributes.
     *
     * @var array
     */
    protected $attributes = [
        Attributes\Id\IdAttribute::class,
        Attributes\Name\NameAttribute::class,
        Attributes\Email\EmailAttribute::class,
        Attributes\Password\PasswordAttribute::class,
        Attributes\Enabled\EnabledAttribute::class,
        Attributes\Role\RoleAttribute::class,
        Attributes\CreatedAt\CreatedAtAttribute::class,
        Attributes\UpdatedAt\UpdatedAtAttribute::class,
        Attributes\Notes\NotesAttribute::class,
        Attributes\Token\TokenAttribute::class,
    ];

    /**
     * List of all exceptions.
     *
     * @var array
     */
    protected $exceptions = [
        Tokens::NOT_AUTHORIZED => Exceptions\UserNotAuthorizedException::class,
    ];

    /**
     * Construct.
     */
    public function __construct(AgentContract $agent = null)
    {
        $this->entity = Config::get('ore.user.entity');
        $this->attributes = array_merge($this->attributes, array_values(Config::get('ore.user.attributes')));
        
        $classRepository = Config::get('ore.user.repository');
        $this->setRepository(new $classRepository($this));

        $classSerializer = Config::get('ore.user.serializer');
        $this->setSerializer(new $classSerializer($this));

        $classAuthorizer = Config::get('ore.user.authorizer');
        $this->setAuthorizer(new $classAuthorizer($this));

        $classValidator = Config::get('ore.user.validator');
        $this->setValidator(new $classValidator($this));

        parent::__construct($agent);
    }
}
