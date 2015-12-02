<?php namespace Auth\Role;

use Auth\Contracts\Role\Repository as Contract;
use Auth\Contracts\Item;
use Auth\Role;
use Auth\Role\Item as RoleItem;
use Auth\Contracts\Role as RoleContract;
use Auth\Role\Permission as RolePermission;
use Auth\Permission;
use DB;

class Repository implements Contract
{
    public function getRole($name)
    {
        // TODO: Implement getRole() method.
        return Role::where('name', $name)->first();
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
        return Role::query()
            ->from(DB::raw('`'.Role::getTable().'` r'))
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
        return Permission::query()
            ->from(DB::raw('`'.Permission::getTable().'` p'))
            ->join(DB::raw('`'.RolePermission::getTable().'` rp'), 'p.id', '=', 'rp.permission_id')
            ->where('role_id', $role->getId())
            ->get(['p.*']);
    }
}