<?php namespace TechExim\Auth\Contracts\Permission;

use TechExim\Auth\Contracts\Item;
use TechExim\Auth\Contracts\Permission;
use TechExim\Auth\Exception\NullPointerException;

interface Repository
{
    /**
     * @param $name
     * @return Permission
     */
    public function getPermission($name);

    /**
     * @param Item $subject
     * @param      $name
     * @param Item $object
     * @return mixed
     */
    public function getPermissionItem(Item $subject, $name, Item $object);

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
}