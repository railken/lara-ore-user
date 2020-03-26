<?php

namespace Amethyst\Repositories;

use Railken\Lem\Repository;
use Illuminate\Database\Eloquent\Collection;

class UserRepository extends Repository
{
    /**
     * Find one user by email.
     *
     * @param string $email
     *
     * @return User|object|null
     */
    public function findOneByEmail(string $email)
    {
        return $this->findOneBy(['email' => $email]);
    }
}
