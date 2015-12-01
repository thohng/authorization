<?php namespace Auth;

use Auth\Role\Contract as Role;
use Auth\Permission\Contract as Permission;
use Auth\Role\Permission as RolePermission;
use Auth\Role\Item as RoleItem;
use Auth\Permission\Item as PermissionItem;

class Guard
{
    public function assignRole(Item $subject, Role $role, Item $object)
    {
        RoleItem::create([
            'subject_type' => $subject->getType(),
            'subject_id'   => $subject->getId(),
            'role_id'      => $role->getId(),
            'object_type'  => $object->getType(),
            'object_id'    => $object->getId()
        ]);
    }

    public function assignPermission(Item $subject, Permission $permission, Item $object)
    {
        PermissionItem::create([
            'subject_type' => $subject->getType(),
            'subject_id'   => $subject->getId(),
            'role_id'      => $permission->getId(),
            'object_type'  => $object->getType(),
            'object_id'    => $object->getId()
        ]);
    }

    public function assignRoleByName(Item $subject, $role, Item $object)
    {

    }

    public function assignPermissionByName(Item $subject, $permission, Item $object)
    {

    }

    public function assignPermissionToRole(Permission $permission, Role $role)
    {
        RolePermission::create([
            'permission_id' => $permission->getId(),
            'role_id' => $role->getId()
        ]);
    }
}