<?php

namespace Railken\Amethyst\Repositories;

use Railken\Lem\Repository;

class UserRepository extends Repository
{
    /**
     * Find one user by email.
     *
     * @param string $email
     *
     * @return User|null|object
     */
    public function findOneByEmail(string $email)
    {
        return $this->findOneBy(['email' => $email]);
    }

    /**
     * Generate token.
     *
     * @return string
     */
    public function generateToken()
    {
        do {
            $token = str_random(32);
        } while ($this->getQuery()->where('token', $token)->count() > 0);

        return $token;
    }

    /**
     * Find all user that have a null token.
     *
     * @param bool $force
     *
     * @return \Illuminate\Support\Collection
     */
    public function findAllToRefreshToken(bool $force = false)
    {
        $query = $this->newQuery();

        return $force ? $query->get() : $query->whereNull('token')->get();
    }
}
