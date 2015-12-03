<?php namespace TechExim\Auth\Role;

use TechExim\Auth\Model;

class Permission extends Model
{
    public function getTable()
    {
        return config('authorization.role.permissions', 'auth_role_permissions');
    }
}