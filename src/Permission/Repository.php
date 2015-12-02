<?php namespace Auth\Permission;

use Auth\Contracts\Permission\Repository as Contract;
use Auth\Contracts\Item;
use Auth\Permission;
use Auth\Permission\Item as PermissionItem;

class Repository implements Contract
{
    public function getPermission($name)
    {
        // TODO: Implement getPermission() method.
        return Permission::where('name', $name)->first();
    }

    public function getPermissionItem(Item $subject, $name, Item $object)
    {
        // TODO: Implement getPermissionItem() method.
        $permission = $this->getPermission($name);
        if ($permission) {
            return PermissionItem::where('permission_id', $permission->getId())
                                 ->where('subject_type', $subject->getType())
                                 ->where('subject_id', $subject->getId())
                                 ->where('object_type', $object->getType())
                                 ->where('object_id', $object->getId())
                                 ->first();
        }

        return null;
    }
}