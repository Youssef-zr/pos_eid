<?php

return [
    'roles_structure' => [
        // "super_admin" => [
        //     'categories' => 'c,r,u,d',
        //     'users' => 'c,r,u,d',
        //     'roles' => 'c,r,u,d',
        // ],
        "super_admin" => []
    ],

    "permissions_map" => [
        'c' => "create",
        'r' => "read",
        'u' => "update",
        'd' => "delete",
    ]
];
