<?php

namespace Railken\LaraOre\User;

use DateTime;
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
     * Find all pending users expired.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function getExpiredPendingUsers()
    {
        return $this->getQuery()->where('enabled', 0)->where('created_at', '<=', (new DateTime())->modify('-3 hours'))->get();
    }

    /**
     * Generate token
     *
     * @return string
     */
    public function generateToken()
    {
        do {
            $token = str_random(8) . "-" . str_random(4) . " - ". str_random(4) . " - ". str_random(8);
        } while ($this->getQuery()->where('token', $token)->count() > 0);

        return $token;
    }
}
