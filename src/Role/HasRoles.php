<?php namespace TechExim\Auth\Role;

use Illuminate\Database\Eloquent\Collection;
use TechExim\Auth\Contracts\Role\Repository as RoleRepository;
use TechExim\Auth\Contracts\Role as RoleContract;

trait HasRoles
{
    /**
     * @return RoleRepository
     */
    protected function getRoleRepository()
    {
        return app(RoleRepository::class);
    }

    /**
     * @return Collection
     */
    public function getRoles()
    {
        return $this->getRoleRepository()->getItemRoles($this);
    }

    /**
     * @param RoleContract $role
     * @return bool
     */
    public function hasRole(RoleContract $role)
    {
        foreach ($this->getRoles() as $objectRole) {
            if ($objectRole instanceof RoleContract && $objectRole->getId() === $role->getId()) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param $name
     * @return bool
     */
    public function hasRoleByName($name)
    {
        $role = $this->getRoleRepository()->getRole($name);
        if ($role) {
            return $this->hasRole($role);
        }

        return false;
    }

    /**
     * @param Collection $roles
     * @return bool
     */
    public function hasRoles(Collection $roles)
    {
        foreach ($roles as $role) {
            if ($role instanceof RoleContract && $this->hasRole($role)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param array $names
     * @return bool
     */
    public function hasRolesByName(array $names)
    {
        return $this->hasRoles($this->getRoleRepository()->getRoles($names));
    }
}