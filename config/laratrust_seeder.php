<?php

return [
    'role_structure' => [
        'superadmin' => [
            'logs' => 'r',
            'users' => 'c,r,u,d',
            'products' => 'c,r,u,d',
            'invoices' => 'c,r,u,d',
        ],
        'admin' => [
            'users' => 'c,r,u,d',
            'products' => 'c,r,u,d',
            'invoices' => 'c,r,u,d',
        ],
        'user' => [
            'products' => 'c,r,u,d',
            'invoices' => 'c,r,u,d',
        ],
    ],
    'permission_structure' => [],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
    ],
];
