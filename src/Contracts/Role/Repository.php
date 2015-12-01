<?php namespace Auth\Contracts\Role;

use Auth\Contracts\Role;

interface Repository
{
    /**
     * @param string $name
     * @return Role
     */
    public function getRole($name);
}