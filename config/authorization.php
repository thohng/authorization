<?php

return [
    /*
	|--------------------------------------------------------------------------
	| Role
	|--------------------------------------------------------------------------
	|
	*/
    'role' => [
        'model' => 'Auth\Role',
        'table' => 'auth_roles',
        'permissions' => 'auth_role_permissions'
    ],

    /*
	|--------------------------------------------------------------------------
	| Permission
	|--------------------------------------------------------------------------
	|
	*/
    'permission' => [
        'model' => 'Auth\Permission',
        'table' => 'auth_permissions'
    ],

    /*
	|--------------------------------------------------------------------------
	| Item
	|--------------------------------------------------------------------------
	|
	*/
    'item' => [
        'role' => 'auth_role_items',
        'permission' => 'auth_permission_items'
    ]
];