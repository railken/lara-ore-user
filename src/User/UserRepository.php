<?php

namespace Railken\LaraOre\User;

use Railken\Laravel\Manager\ModelRepository;

class UserRepository extends ModelRepository
{
    /**
     * Find one user by email.
     *
     * @param string $email
     *
     * @return User
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
