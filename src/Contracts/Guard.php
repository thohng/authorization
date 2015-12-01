<?php namespace Auth\Contracts;

interface Guard
{
    /**
     * @param Item $subject
     * @param Role $role
     * @param Item $object
     * @return void
     */
    public function assignRole(Item $subject, Role $role, Item $object);

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
     */
    public function assignRoleByName(Item $subject, $name, Item $object);

    /**
     * @param Item   $subject
     * @param string $name
     * @param Item   $object
     * @return void
     */
    public function assignPermissionByName(Item $subject, $name, Item $object);

    /**
     * @param Permission $permission
     * @param Role       $role
     * @return void
     */
    public function assignPermissionToRole(Permission $permission, Role $role);
}