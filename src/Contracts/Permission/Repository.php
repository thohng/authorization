<?php namespace TechExim\Auth\Contracts\Permission;

use TechExim\Auth\Contracts\Item;
use TechExim\Auth\Contracts\Permission;
use TechExim\Exception\NullPointerException;

interface Repository
{
    /**
     * @param $name
     * @return Permission
     */
    public function create($name);

    /**
     * @param Permission $permission
     * @return void
     */
    public function delete(Permission $permission);

    /**
     * @param int|string $name
     * @return Permission
     */
    public function getPermission($name);

    /**
     * @param array $names
     * @return mixed
     */
    public function getPermissions($names = []);

    /**
     * @param Item $item
     * @return Permission[]
     */
    public function getItemPermissions(Item $item);

    /**
     * @param Item $item
     * @param Permission $permission
     * @return bool
     */
    public function hasItemPermission(Item $item, Permission $permission);

    /**
     * @param Item   $item
     * @param string $name
     * @return bool
     */
    public function hasItemPermissionName(Item $item, $name);

    /**
     * @param Item $item
     * @param Permission $permission
     * @return void
     */
    public function assignItemPermission(Item $item, Permission $permission);

    /**
     * @param Item   $item
     * @param string $name
     * @return void
     *
     * @throws NullPointerException
     */
    public function assignItemPermissionName(Item $item, $name);

    /**
     * @param Item $item
     * @param Permission $permission
     * @return void
     */
    public function removeItemPermission(Item $item, Permission $permission);

    /**
     * @param Item   $item
     * @param string $name
     * @return void
     *
     * @throws NullPointerException
     */
    public function removeItemPermissionName(Item $item, $name);

    /**
     * @param Item $subject
     * @param Item $object
     * @return Permission[]
     */
    public function getObjectPermissions(Item $subject, Item $object);

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
     * @param Permission $permission
     * @param Item $object
     * @return bool
     */
    public function hasObjectPermission(Item $subject, Permission $permission, Item $object);

    /**
     * @param Item   $subject
     * @param string $name
     * @param Item   $object
     * @return bool
     */
    public function hasObjectPermissionName(Item $subject, $name, Item $object);

    /**
     * @param Item $subject
     * @param Permission $permission
     * @param Item $object
     * @return void
     */
    public function assignObjectPermission(Item $subject, Permission $permission, Item $object);

    /**
     * @param Item   $subject
     * @param string $name
     * @param Item   $object
     * @return void
     *
     * @throws NullPointerException
     */
    public function assignObjectPermissionName(Item $subject, $name, Item $object);

    /**
     * @param Item $subject
     * @param Permission $permission
     * @param Item $object
     * @return void
     */
    public function removeObjectPermission(Item $subject, Permission $permission, Item $object);

    /**
     * @param Item   $subject
     * @param string $name
     * @param Item   $object
     * @return void
     *
     * @throws NullPointerException
     */
    public function removeObjectPermissionName(Item $subject, $name, Item $object);
}