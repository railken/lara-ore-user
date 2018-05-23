<?php

namespace Railken\LaraOre\User\Events;

use Illuminate\Queue\SerializesModels;
use Railken\LaraOre\User\User;

class UserRequestChangeEmail
{
    use SerializesModels;

    public $user;

    /**
     * Create a new event instance.
     *
     * @param User $user
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
