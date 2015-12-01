<?php namespace Auth\Permission;

use Auth\Contracts\Permission\Repository as Contract;
use Auth\Permission;

class Repository implements Contract
{
    public function getPermission($name)
    {
        // TODO: Implement getPermission() method.
        return Permission::where('name', $name)->first();
    }
}