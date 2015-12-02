<?php namespace Auth\Contracts\Role;

use Auth\Contracts\Item;
use Auth\Contracts\Role;

interface Repository
{
    /**
     * @param string $name
     * @return Role
     */
    public function getRole($name);

    /**
     * @param Item   $subject
     * @param string $name
     * @param Item   $object
     * @return mixed
     */
    public function getRoleItem(Item $subject, $name, Item $object);

    /**
     * @param Item $subject
     * @param Item $object
     * @return mixed
     */
    public function getSubjectRoles(Item $subject, Item $object);

    /**
     * @param Role $role
     * @return mixed
     */
    public function getPermissions(Role $role);
}