<?php namespace TechExim\Auth\Contracts\Role;

use TechExim\Auth\Contracts\Role;

interface HasRoles
{
    /**
     * @return mixed
     */
    public function getRoles();

    /**
     * @param Role $role
     * @return bool
     */
    public function hasRole(Role $role);

    /**
     * @param $name
     * @return bool
     */
    public function hasRoleByName($name);
}