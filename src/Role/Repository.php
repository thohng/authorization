<?php namespace TechExim\Auth\Role;

use TechExim\Auth\Contracts\Role\Repository as Contract;
use TechExim\Auth\Contracts\Item;
use TechExim\Auth\Role\Item as RoleItem;
use TechExim\Auth\Role\Object as RoleObject;
use TechExim\Auth\Role\Permission as RolePermission;
use TechExim\Auth\Contracts\Role as RoleContract;
use TechExim\Auth\Contracts\Permission as PermissionContract;
use DB;

class Repository implements Contract
{
    /**
     * @var RoleContract
     */
    protected $role;

    protected $permission;

    public function __construct(RoleContract $role, PermissionContract $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }

    public function getRole($name)
    {
        // TODO: Implement getRole() method.
        return $this->role->query()->where('name', $name)->first();
    }

    public function getRoleItem(Item $subject, $name, Item $object)
    {
        // TODO: Implement getRoleItem() method.
        $role = $this->getRole($name);
        if ($role) {
            return RoleItem::where('role_id', $role->getId())
                           ->where('subject_type', $subject->getType())
                           ->where('subject_id', $subject->getId())
                           ->where('object_type', $object->getType())
                           ->where('object_id', $object->getId())
                           ->first();
        }

        return null;
    }

    public function getSubjectRoles(Item $subject, Item $object)
    {
        // TODO: Implement getSubjectRoles() method.
        return $this->role->query()
            ->from(DB::raw('`'.$this->role->getTable().'` r'))
            ->join('`'.RoleItem::getTable().'` ri', 'r.id', '=', 'ri.role_id')
            ->where('subject_type', $subject->getType())
            ->where('subject_id', $subject->getId())
            ->where('object_type', $object->getType())
            ->where('object_id', $object->getId())
            ->get(['r.*']);
    }

    public function getPermissions(RoleContract $role)
    {
        // TODO: Implement getPermissions() method.
        return $this->permission->query()
            ->from(DB::raw('`'.$this->permission->getTable().'` p'))
            ->join(DB::raw('`'.RolePermission::getTable().'` rp'), 'p.id', '=', 'rp.permission_id')
            ->where('role_id', $role->getId())
            ->get(['p.*']);
    }

    public function create($name)
    {
        // TODO: Implement create() method.
        if (!$this->getRole($name)) {
            return $this->role->create(['name' => $name]);
        }
    }

    public function remove(RoleContract $role)
    {
        // TODO: Implement remove() method.
        foreach ($this->getPermissions($role) as $permission) {
            $permission->delete();
        }

        $role->delete();
    }

    public function getRoles($names = [])
    {
        // TODO: Implement getRoles() method.
        $query = $this->role->query();
        if (count($names)) {
            $query->whereIn('name', $names);
        }

        return $query->get();
    }

    public function assignPermission(RoleContract $role, PermissionContract $permission)
    {
        // TODO: Implement assignPermission() method.
        if (!RolePermission::where('permission_id', $permission->getId())
            ->where('role_id', $role->getId())
            ->first()) {
            RolePermission::create([
                'permission_id' => $permission->getId(),
                'role_id' => $role->getId()
            ]);
        }
    }

    public function assignObject(RoleContract $role, Item $object)
    {
        // TODO: Implement assignObject() method.
        if (!RoleObject::where('object_type', $object->getType())
            ->where('object_id', $object->getId())
            ->where('role_id', $role->getId())
            ->first()) {
            RoleObject::create([
                'object_type' => $object->getType(),
                'object_id' => $object->getId(),
                'role_id' => $role->getId()
            ]);
        }
    }

    public function assignObjectByName($name, Item $object)
    {
        // TODO: Implement assignObjectByName() method.
        $role = $this->getRole($name);
        if ($role) {
            $this->assignObject($object, $role);
        }
    }
}