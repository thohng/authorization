<?php namespace TechExim\Auth;

use TechExim\Auth\Contracts\Guard as Contract;
use TechExim\Auth\Contracts\Item;
use TechExim\Auth\Contracts\Role;
use TechExim\Auth\Contracts\Permission;
use TechExim\Auth\Contracts\Permission\HasPermissions;
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

    public function hasPermissionTo(Item $subject, $action, Item $object)
    {
        // TODO: Implement hasPermissionTo() method.
        if ($this->permission->hasObjectPermissionName($subject, $action, $object)) {
            return true;
        }

        foreach ($this->role->getObjectRoles($subject, $object) as $role) {
            if ($role instanceof HasPermissions) {
                foreach ($role->getPermissions() as $permission) {
                    if ($permission instanceof Permission
                        && $permission->getName() === $action) {
                        return true;
                    }
                }
            }
        }

        return false;
    }

    public function hasPermission(Item $subject, $action)
    {
        if ($this->permission->hasItemPermissionName($subject, $action)) {
            return true;
        }

        foreach ($this->role->getItemRoles($subject) as $role) {
            if ($role instanceof HasPermissions) {
                foreach ($role->getPermissions() as $permission) {
                    if ($permission instanceof Permission
                        && $permission->getName() === $action) {
                        return true;
                    }
                }
            }
        }

        return false;
    }
}