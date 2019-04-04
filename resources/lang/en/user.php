<?php

return [
	'name' => 'User',
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
		]
    ]
];