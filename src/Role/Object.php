<?php namespace TechExim\Auth\Role;

use TechExim\Auth\Model;

class Object extends Model
{
    public function getTable()
    {
        return config('authorization.role.object', 'auth_role_objects');
    }
}