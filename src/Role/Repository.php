<?php namespace Auth\Role;

use Auth\Role;
use Auth\Contracts\Role\Repository as Contract;

class Repository implements Contract
{
    public function getRole($name)
    {
        // TODO: Implement getRole() method.
        return Role::where('name', $name)->first();
    }
}