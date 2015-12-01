<?php namespace Auth;

use Auth\Contracts\Item;
use Auth\Contracts\Role;
use Auth\Contracts\Permission;
use Auth\Role\Permission as RolePermission;
use Auth\Role\Item as RoleItem;
use Auth\Permission\Item as PermissionItem;
use Auth\Contracts\Role\Repository as RoleRepository;
use Auth\Contracts\Permission\Repository as PermissionRepository;

class Guard
{
    /**
     * @var RoleRepository
     */
    protected $role;

    /**
     * @var PermissionRepository
     */
    protected $permission;

    public function __construct(RoleRepository $role, PermissionRepository $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }

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

    public function assignRoleByName(Item $subject, $name, Item $object)
    {
        $role = $this->role->findRoleByName($name);
        return $this->assignRole($subject, $role, $object);
    }

    public function assignPermissionByName(Item $subject, $name, Item $object)
    {
        $permission = $this->permission->findPermissionByName($name);
        return $this->assignPermission($subject, $permission, $object);
    }

    public function assignPermissionToRole(Permission $permission, Role $role)
    {
        RolePermission::create([
            'permission_id' => $permission->getId(),
            'role_id' => $role->getId()
        ]);
    }
}