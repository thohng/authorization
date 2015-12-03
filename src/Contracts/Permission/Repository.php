<?php namespace TechExim\Auth\Contracts\Permission;

use TechExim\Auth\Contracts\Item;
use TechExim\Auth\Contracts\Permission;
use TechExim\Auth\Exception\NullPointerException;

interface Repository
{
    /**
     * @param int|string $name
     * @return Permission
     */
    public function getPermission($name);

    /**
     * @param $name
     * @return Permission
     */
    public function create($name);

    /**
     * @param Permission $permission
     * @return void
     */
    public function remove(Permission $permission);

    /**
     * @param array $names
     * @return mixed
     */
    public function getPermissions($names = []);

    /**
     * @param Item       $subject
     * @param Permission $permission
     * @param Item       $object
     * @return void
     */
    public function assignPermission(Item $subject, Permission $permission, Item $object);

    /**
     * @param Item   $subject
     * @param string $name
     * @param Item   $object
     * @return void
     *
     * @throws NullPointerException
     */
    public function assignPermissionByName(Item $subject, $name, Item $object);

    /**
     * @param Item       $subject
     * @param Permission $permission
     * @param Item       $object
     * @return bool
     */
    public function hasPermission(Item $subject, Permission $permission, Item $object);

    /**
     * @param Item   $subject
     * @param string $name
     * @param Item   $object
     * @return bool
     */
    public function hasPermissionByName(Item $subject, $name, Item $object);

    /**
     * @param Item       $subject
     * @param Permission $permission
     * @param Item       $object
     * @return mixed
     */
    public function getPermissionItem(Item $subject, Permission $permission, Item $object);

    /**
     * @param Item   $subject
     * @param string $name
     * @param Item   $object
     * @return mixed
     */
    public function getPermissionItemByName(Item $subject, $name, Item $object);

    /**
     * @param Item       $subject
     * @param Permission $permission
     * @param Item       $object
     * @return mixed
     */
    public function removePermission(Item $subject, Permission $permission, Item $object);

    /**
     * @param Item   $subject
     * @param string $name
     * @param Item   $object
     * @return mixed
     */
    public function removePermissionByName(Item $subject, $name, Item $object);
}