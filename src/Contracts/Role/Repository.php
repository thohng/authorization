<?php namespace TechExim\Auth\Contracts\Role;

use TechExim\Auth\Contracts\Item;
use TechExim\Auth\Contracts\Role;
use TechExim\Auth\Contracts\Permission;
use TechExim\Exception\NullPointerException;

interface Repository
{
    /**
     * @param $name
     * @return Role
     */
    public function create($name);

    /**
     * @param Role $role
     * @return void
     */
    public function delete(Role $role);

    /**
     * @param int|string $name
     * @return Role
     */
    public function getRole($name);

    /**
     * @param array $names
     * @return Role[]
     */
    public function getRoles(array $names = []);

    /**
     * @param Item $item
     * @return Role[]
     */
    public function getItemRoles(Item $item);

    /**
     * @param Item $item
     * @param Role $role
     * @return bool
     */
    public function hasItemRole(Item $item, Role $role);

    /**
     * @param Item   $item
     * @param string $name
     * @return bool
     */
    public function hasItemRoleName(Item $item, $name);

    /**
     * @param Item $item
     * @param Role $role
     * @return void
     */
    public function assignItemRole(Item $item, Role $role);

    /**
     * @param Item   $item
     * @param string $name
     * @return void
     *
     * @throws NullPointerException
     */
    public function assignItemRoleName(Item $item, $name);

    /**
     * @param Item $item
     * @param Role $role
     * @return void
     */
    public function removeItemRole(Item $item, Role $role);

    /**
     * @param Item   $item
     * @param string $name
     * @return void
     *
     * @throws NullPointerException
     */
    public function removeItemRoleName(Item $item, $name);

    /**
     * @param Item $subject
     * @param Item $object
     * @return Role[]
     */
    public function getObjectRoles(Item $subject, Item $object);

    /**
     * @param string $type subject's class
     * @param Item   $object
     * @param bool   $withTrashed
     * @return mixed
     */
    public function getSubjectItems($type, Item $object, $withTrashed = false);

    /**
     * @param Item   $subject
     * @param string $type object's class
     * @param bool   $withTrashed
     * @return mixed
     */
    public function getObjectItems(Item $subject, $type, $withTrashed = false);

    /**
     * @param Item $subject
     * @param Role $role
     * @param Item $object
     * @return bool
     */
    public function hasObjectRole(Item $subject, Role $role, Item $object);

    /**
     * @param Item   $subject
     * @param string $name
     * @param Item   $object
     * @return bool
     */
    public function hasObjectRoleName(Item $subject, $name, Item $object);

    /**
     * @param Item $subject
     * @param Role $role
     * @param Item $object
     * @return void
     */
    public function assignObjectRole(Item $subject, Role $role, Item $object);

    /**
     * @param Item   $subject
     * @param string $name
     * @param Item   $object
     * @return void
     *
     * @throws NullPointerException
     */
    public function assignObjectRoleName(Item $subject, $name, Item $object);

    /**
     * @param Item $subject
     * @param Role $role
     * @param Item $object
     * @return void
     */
    public function removeObjectRole(Item $subject, Role $role, Item $object);

    /**
     * @param Item   $subject
     * @param string $name
     * @param Item   $object
     * @return void
     *
     * @throws NullPointerException
     */
    public function removeObjectRoleName(Item $subject, $name, Item $object);
}