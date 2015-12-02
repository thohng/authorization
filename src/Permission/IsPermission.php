<?php namespace TechExim\Auth\Permission;

trait IsPermission
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

    public function getTable()
    {
        return config('authorization.permission.table', 'auth_permissions');
    }
}