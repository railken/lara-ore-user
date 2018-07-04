<?php

namespace Railken\LaraOre\User\Attributes\Token;

use Railken\Laravel\Manager\Attributes\BaseAttribute;
use Railken\Laravel\Manager\Contracts\EntityContract;
use Railken\Laravel\Manager\Tokens;
use Respect\Validation\Validator as v;

class TokenAttribute extends BaseAttribute
{
    /**
     * Name attribute.
     *
     * @var string
     */
    protected $name = 'token';

    /**
     * Is the attribute required
     * This will throw not_defined exception for non defined value and non existent model.
     *
     * @var bool
     */
    protected $required = false;

    /**
     * Is the attribute unique.
     *
     * @var bool
     */
    protected $unique = false;

    /**
     * List of all exceptions used in validation.
     *
     * @var array
     */
    protected $exceptions = [
        Tokens::NOT_DEFINED    => Exceptions\UserTokenNotDefinedException::class,
        Tokens::NOT_VALID      => Exceptions\UserTokenNotValidException::class,
        Tokens::NOT_AUTHORIZED => Exceptions\UserTokenNotAuthorizedException::class,
        Tokens::NOT_UNIQUE     => Exceptions\UserTokenNotUniqueException::class,
    ];

    /**
     * List of all permissions.
     */
    protected $permissions = [
        Tokens::PERMISSION_FILL => 'user.attributes.token.fill',
        Tokens::PERMISSION_SHOW => 'user.attributes.token.show',
    ];

    /**
     * Is a value valid ?
     *
     * @param EntityContract $entity
     * @param mixed          $value
     *
     * @return bool
     */
    public function valid(EntityContract $entity, $value)
    {
        return v::length(1, 255)->validate($value);
    }

    /**
     * Retrieve default value.
     *
     * @param EntityContract $entity
     *
     * @return mixed
     */
    public function getDefault(EntityContract $entity)
    {
        return $this->getManager()->getRepository()->generateToken();
    }
}
