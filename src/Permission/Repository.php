<?php namespace TechExim\Auth\Permission;

use TechExim\Auth\Contracts\Permission\Repository as Contract;
use TechExim\Auth\Contracts\Item;
use TechExim\Auth\Permission\Item as PermissionItem;
use TechExim\Auth\Contracts\Permission as PermissionContract;

class Repository implements Contract
{
    /**
     * @var PermissionContract
     */
    protected $permission;

    public function __construct(PermissionContract $permission)
    {
        $this->permission = $permission;
    }

    public function getPermission($name)
    {
        // TODO: Implement getPermission() method.
        return $this->permission->query()->where('name', $name)->first();
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

    public function create($name)
    {
        // TODO: Implement create() method.
        return $this->permission->create(['name' => $name]);
    }

    public function remove(PermissionContract $permission)
    {
        // TODO: Implement remove() method.
        $permission->delete();
    }

    public function getPermissions($names = [])
    {
        // TODO: Implement getPermissions() method.
        $query = $this->permission->query();
        if (count($names)) {
            $query->whereIn('name', $names);
        }

        return $query->get();
    }

    public function assignPermission(Item $subject, PermissionContract $permission, Item $object)
    {
        PermissionItem::create([
            'subject_type' => $subject->getType(),
            'subject_id'   => $subject->getId(),
            'role_id'      => $permission->getId(),
            'object_type'  => $object->getType(),
            'object_id'    => $object->getId()
        ]);
    }

    public function assignPermissionByName(Item $subject, $name, Item $object)
    {
        $permission = $this->getPermission($name);
        if (is_null($permission)) {
            throw new NullPointerException('Unable to find appropriate permission');
        }
        return $this->assignPermission($subject, $permission, $object);
    }

    public function hasPermission(Item $subject, PermissionContract $permission, Item $object)
    {
        // TODO: Implement hasPermission() method.
        return PermissionItem::where('permission_id', $permission->getId())
            ->where('subject_type', $subject->getType())
            ->where('subject_id', $subject->getId())
            ->where('object_type', $object->getType())
            ->where('object_id', $object->getId())
            ->first() ? true : false;
    }

    public function hasPermissionByName(Item $subject, $name, Item $object)
    {
        // TODO: Implement hasPermissionByName() method.
        $permission = $this->getPermission($name);
        if ($permission) {
            return $this->hasPermission($subject, $permission, $object);
        }

        return false;
    }
}