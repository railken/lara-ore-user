<?php

namespace Railken\LaraOre\User\Attributes\Notes\Exceptions;

use Railken\LaraOre\User\Exceptions\UserAttributeException;

class UserNotesNotAuthorizedException extends UserAttributeException
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
    protected $code = 'USER_NOTES_NOT_AUTHTORIZED';

    /**
     * The message.
     *
     * @var string
     */
    protected $message = "You're not authorized to interact with %s, missing %s permission";
}
