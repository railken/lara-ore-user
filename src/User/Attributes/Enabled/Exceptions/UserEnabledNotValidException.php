<?php

namespace Railken\LaraOre\User\Attributes\Enabled\Exceptions;

use Railken\LaraOre\User\Exceptions\UserAttributeException;

class UserEnabledNotValidException extends UserAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'enabled';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'USER_ENABLED_NOT_VALID';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is not valid';
}
