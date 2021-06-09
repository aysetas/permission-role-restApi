<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'admin' => [
            'product' => 'c,r,u,d',
            'category' => 'c,r,u,d'
        ],
        'user' => [

        ],
        'superadmin' => [
            'product' => 'c,r',
            'category' => 'c,r'
        ],

    ],

    'permissions_map' => [

        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
