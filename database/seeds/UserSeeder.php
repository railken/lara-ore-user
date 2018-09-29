<?php

namespace Railken\Amethyst\Database\Seeds;

use Illuminate\Database\Seeder;
use Railken\Amethyst\Managers\UserManager;

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
            $um->createOrFail($user);
        }

        return 1;
    }
}
