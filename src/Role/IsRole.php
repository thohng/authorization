<?php namespace TechExim\Auth\Role;

trait IsRole
{
    public function getName()
    {
        // TODO: Implement getName() method.
        return $this->name;
    }

    public function getId()
    {
        // TODO: Implement getId() method.
        return $this->id;
    }

    public function getPermissions()
    {
        // TODO: Implement getPermissions() method.
        return $this->permissions;
    }

    public function permissions()
    {
        $model = config('authorization.permission.model', 'TechExim\Auth\Permission');
        $table = config('authorization.role.permissions', 'auth_permissions');
        return $this->belongsToMany($model, $table, 'role_id', 'permission_id');
    }

    public function getTable()
    {
        return config('authorization.role.table', 'auth_roles');
    }
}