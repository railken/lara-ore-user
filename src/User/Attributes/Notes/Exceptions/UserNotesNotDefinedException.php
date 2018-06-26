<?php

namespace Railken\LaraOre\User\Attributes\Notes\Exceptions;

use Railken\LaraOre\User\Exceptions\UserAttributeException;

class UserNotesNotDefinedException extends UserAttributeException
{
    /**
     * The reason (attribute) for which this exception is thrown.
     *
     * @var string
     */
    protected $attribute = 'notes';

    /**
     * The code to identify the error.
     *
     * @var string
     */
    protected $code = 'USER_NOTES_NOT_DEFINED';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is required';
}
