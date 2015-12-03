<?php namespace TechExim\Auth;

use TechExim\Auth\Contracts\Guard as Contract;
use TechExim\Auth\Contracts\Item;
use TechExim\Auth\Contracts\Role;
use TechExim\Auth\Contracts\Permission;
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