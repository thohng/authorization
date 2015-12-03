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

    /**
     * @var PermissionContract
     */
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
            ->join(DB::raw('`'.with(new RoleItem)->getTable().'` ri'), 'r.id', '=', 'ri.role_id')
            ->where('ri.subject_type', $subject->getType())
            ->where('ri.subject_id', $subject->getId())
            ->where('ri.object_type', $object->getType())
            ->where('ri.object_id', $object->getId())
            ->whereNull('r.deleted_at')
            ->withTrashed()
            ->get(['r.*']);
    }

    public function getPermissions(RoleContract $role)
    {
        // TODO: Implement getPermissions() method.
        return $this->permission->query()
            ->from(DB::raw('`'.$this->permission->getTable().'` p'))
            ->join(DB::raw('`'.with(new RolePermission)->getTable().'` rp'), 'p.id', '=', 'rp.permission_id')
            ->where('rp.role_id', $role->getId())
            ->whereNull('p.deleted_at')
            ->withTrashed()
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
            $this->assignObject($role, $object);
        }
    }

    public function getObjectRoles(Item $object)
    {
        // TODO: Implement getObjectRoles() method.
        return $this->role->query()
            ->from(DB::raw('`'.$this->role->getTable().'` r'))
            ->join(DB::raw('`'.with(new RoleObject)->getTable().'` ro'), 'r.id', '=', 'ro.role_id')
            ->where('ro.object_type', $object->getType())
            ->where('ro.object_id', $object->getId())
            ->whereNull('r.deleted_at')
            ->withTrashed()
            ->get(['r.*']);
    }

    public function assignRole(Item $subject, RoleContract $role, Item $object)
    {
        if (!$this->hasRole($subject, $role, $object)) {
            RoleItem::create([
                'subject_type' => $subject->getType(),
                'subject_id'   => $subject->getId(),
                'role_id'      => $role->getId(),
                'object_type'  => $object->getType(),
                'object_id'    => $object->getId()
            ]);
        }
    }

    public function assignRoleByName(Item $subject, $name, Item $object)
    {
        $role = $this->getRole($name);
        if (is_null($role)) {
            throw new NullPointerException('Unable to find appropriate role');
        }
        return $this->assignRole($subject, $role, $object);
    }

    public function hasRole(Item $subject, RoleContract $role, Item $object)
    {
        // TODO: Implement hasRole() method.
        return RoleItem::where('subject_type', $subject->getType())
            ->where('subject_id', $subject->getId())
            ->where('object_type', $object->getType())
            ->where('object_id', $object->getId())
            ->where('role_id', $role->getId())
            ->first() ? true : false;
    }

    public function hasRoleByName(Item $subject, $name, Item $object)
    {
        // TODO: Implement hasRoleByName() method.
        $role = $this->getRole($name);
        if ($role) {
            return $this->hasRole($subject, $role, $object);
        }

        return false;
    }
}