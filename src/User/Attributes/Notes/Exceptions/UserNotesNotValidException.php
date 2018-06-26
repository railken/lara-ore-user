<?php

namespace Railken\LaraOre\User\Attributes\Notes\Exceptions;

use Railken\LaraOre\User\Exceptions\UserAttributeException;

class UserNotesNotValidException extends UserAttributeException
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
    protected $code = 'USER_NOTES_NOT_VALID';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = 'The %s is not valid';
}
