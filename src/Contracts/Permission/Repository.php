<?php namespace TechExim\Auth\Contracts\Permission;

use TechExim\Auth\Contracts\Permission;
use TechExim\Auth\Contracts\Item;

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
     * @return mixed
     */
    public function getPermissions();
}