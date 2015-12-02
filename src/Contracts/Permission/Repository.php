<?php namespace Auth\Contracts\Permission;

use Auth\Contracts\Permission;
use Auth\Contracts\Item;

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
}