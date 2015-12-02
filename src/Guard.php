<?php namespace TechExim\Auth;

use TechExim\Auth\Contracts\Guard as Contract;
use TechExim\Auth\Contracts\Item;
use TechExim\Auth\Contracts\Role;
use TechExim\Auth\Contracts\Permission;
use TechExim\Auth\Exception\NullPointerException;
use TechExim\Auth\Role\Permission as RolePermission;
use TechExim\Auth\Role\Item as RoleItem;
use TechExim\Auth\Permission\Item as PermissionItem;
use TechExim\Auth\Contracts\Role\Repository as RoleRepository;
use TechExim\Auth\Contracts\Permission\Repository as PermissionRepository;

class Guard implements Contract
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
        $role = $this->role->getRole($name);
        if (is_null($role)) {
            throw new NullPointerException('Unable to find appropriate role');
        }
        return $this->assignRole($subject, $role, $object);
    }

    public function assignPermissionByName(Item $subject, $name, Item $object)
    {
        $permission = $this->permission->getPermission($name);
        if (is_null($permission)) {
            throw new NullPointerException('Unable to find appropriate permission');
        }
        return $this->assignPermission($subject, $permission, $object);
    }

    public function assignPermissionToRole(Permission $permission, Role $role)
    {
        RolePermission::create([
            'permission_id' => $permission->getId(),
            'role_id' => $role->getId()
        ]);
    }

    public function hasPermissionTo(Item $subject, $action, Item $object)
    {
        // TODO: Implement can() method.
        if ($this->permission->getPermissionItem($subject, $action, $object)) {
            return true;
        }

        foreach ($this->role->getSubjectRoles($subject, $object) as $role) {
            foreach ($this->role->getPermissions($role) as $permission) {
                if ($permission instanceof Permission
                    && $this->permission->getPermissionItem($subject, $permission->getName(), $object)) {
                    return true;
                }
            }
        }

        return false;
    }
}