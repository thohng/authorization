<?php namespace TechExim\Auth\Role;

use TechExim\Auth\Contracts\Role\Repository as RoleRepository;
use TechExim\Auth\Contracts\Role;

trait HasRoles
{
    /**
     * @return RoleRepository
     */
    protected function getRoleRepository()
    {
        return app(RoleRepository::class);
    }

    public function getRoles()
    {
        return $this->getRoleRepository()->getObjectRoles($this);
    }

    public function hasRole(Role $role)
    {
        foreach ($this->getRoles() as $objectRole) {
            if ($objectRole instanceof Role && $objectRole->getId() === $role->getId()) {
                return true;
            }
        }

        return false;
    }

    public function hasRoleByName($name)
    {
        $role = $this->getRoleRepository()->getRole($name);
        if ($role) {
            return $this->hasRole($role);
        }

        return false;
    }
}