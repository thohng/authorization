<?php

return [
    /*
	|--------------------------------------------------------------------------
	| Role
	|--------------------------------------------------------------------------
	|
	*/
    'role'       => [
        'model'       => 'TechExim\Auth\Role\Role',
        'table'       => 'auth_roles',
        'permissions' => 'auth_role_permissions',
        'items'       => 'auth_role_items',
        'objects'     => 'auth_role_objects'
    ],

    /*
	|--------------------------------------------------------------------------
	| Permission
	|--------------------------------------------------------------------------
	|
	*/
    'permission' => [
        'model'   => 'TechExim\Auth\Permission\Permission',
        'table'   => 'auth_permissions',
        'items'   => 'auth_permission_items',
        'objects' => 'auth_permission_objects'
    ]
];