<?php

return [
    'name' => 'Utente',
    'description' => 'Credenziali e autenticazione',
    'attributes' => [
        'name' => [
            'label' => 'Nome',
            'description' => 'Come possiamo chiamarlo?'
        ],
        'email' => [
            'label' => 'Email',
            'description' => 'L'email usata per il processo di autenticazione'
        ],
        'password' => [
            'label' => 'Password',
            'description' => 'Una parola o frase segreta usata per il processo di autenticazione'
        ]
    ]
];