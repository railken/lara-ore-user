<?php

return [
    'name' => 'User',
    'description' => 'Credentials and Authentications',
    'attributes' => [
        'name' => [
            'label' => 'Name',
            'description' => 'How shall we call him/her?'
        ],
        'email' => [
            'label' => 'Email',
            'description' => 'The Email used for the authentication process'
        ],
        'password' => [
            'label' => 'Password',
            'description' => 'A secret word or phrase used for the authentication process'
        ],
        'token' => [
            'label' => 'Token',
            'description' => 'A public token used in a variety of cases'
        ],
        'role' => [
            'label' => 'Role',
            'description' => 'Indentify the role of the user'
        ]
    ]
];