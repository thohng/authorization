<?php namespace Auth\Role;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public function getTable()
    {
        return config('authorization.role.permissions');
    }
}