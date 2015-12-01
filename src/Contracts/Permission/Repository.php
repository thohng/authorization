<?php namespace Auth\Contracts\Permission;

use Auth\Contracts\Permission;

interface Repository
{
    /**
     * @param $name
     * @return Permission
     */
    public function getPermission($name);
}