<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Table
    |--------------------------------------------------------------------------
    |
    | This is the table used to save users to the database
    |
    */
    'table' => 'ore_users',

    /*
    |--------------------------------------------------------------------------
    | Entity
    |--------------------------------------------------------------------------
    |
    | The class user
    |
    */
    'entity' => Railken\LaraOre\User\User::class,

    /*
    |--------------------------------------------------------------------------
    | Permission
    |--------------------------------------------------------------------------
    |
    | Permission config
    |
    */
    'permission' => [
        'managers' => [
            Railken\LaraOre\User\UserManager::class
        ]
    ],


    'router' => [
        'prefix' => 'api/v1/admin/users',
        'middlewares' => [
             'auth:api',
        ]
    ]
];
