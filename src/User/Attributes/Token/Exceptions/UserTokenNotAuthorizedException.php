<?php

namespace Railken\LaraOre\User\Attributes\Token\Exceptions;

use Railken\LaraOre\User\Exceptions\UserAttributeException;

class UserTokenNotAuthorizedException extends UserAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'token';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'USER_TOKEN_NOT_AUTHTORIZED';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = "You're not authorized to interact with %s, missing %s permission";
}
