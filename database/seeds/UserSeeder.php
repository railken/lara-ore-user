<?php

namespace Amethyst\Database\Seeds;

use Amethyst\Managers\UserManager;
use Illuminate\Database\Seeder;

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
