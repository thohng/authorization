<?php namespace TechExim\Auth\Role;

use TechExim\Auth\Model;

class Permission extends Model
{
    /**
     * The primary keys for the model.
     *
     * @var array
     */
    protected $primaryKey = [
        'role_id',
        'permission_id'
    ];

    public function getTable()
    {
        return config('authorization.role.permissions', 'auth_role_permissions');
    }
}