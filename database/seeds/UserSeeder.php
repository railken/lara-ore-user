<?php

namespace Railken\LaraOre\User\Database\Seeds;

use Illuminate\Database\Seeder;
use Railken\LaraOre\User\UserManager;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $users = [
            [
                'name'     => 'admin',
                'email'    => 'admin@admin.com',
                'password' => 'vercingetorige',
                'role'     => 'admin',
                'enabled'  => 1,
            ],
        ];

        $um = new UserManager();

        foreach ($users as $user) {
            $result = $um->create($user);

            if (!$result->ok()) {
                return 0;
            }
        }

        return 1;
    }
}
