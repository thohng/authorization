<?php namespace TechExim\Auth\Contracts\Role;

use TechExim\Auth\Contracts\Item;
use TechExim\Auth\Contracts\Role;
use TechExim\Auth\Contracts\Permission;

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

    /**
     * @param $name
     * @return Role
     */
    public function create($name);

    /**
     * @param Role $role
     * @return void
     */
    public function remove(Role $role);

    /**
     * @param array $names
     * @return mixed
     */
    public function getRoles($names = []);

    /**
     * @param Role       $role
     * @param Permission $permission
     * @return mixed
     */
    public function assignPermission(Role $role, Permission $permission);

    /**
     * Assign a role to an object
     *
     * @param Role $role
     * @param Item $object
     * @return mixed
     */
    public function assignObject(Role $role, Item $object);

    /**
     * Assign a name (role) to an object
     * @param      $name
     * @param Item $object
     * @return mixed
     */
    public function assignObjectByName($name, Item $object);
}