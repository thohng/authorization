<?php namespace TechExim\Auth\Permission;

use Illuminate\Support\Facades\Event;
use TechExim\Auth\Contracts\Permission\Repository as Contract;
use TechExim\Auth\Contracts\Item as ItemContract;
use TechExim\Auth\Contracts\Permission as PermissionContract;

class Repository implements Contract
{
    /**
     * @return string
     */
    private function getPermissionTable()
    {
        return app(Permission::class)->getTable();
    }

    /**
     * @return string
     */
    private function getPermissionItemTable()
    {
        return app(Item::class)->getTable();
    }

    /**
     * @return string
     */
    private function getPermissionObjectTable()
    {
        return app(Object::class)->getTable();
    }

    public function create($name)
    {
        // TODO: Implement create() method.
        $permission = $this->getPermission($name);
        if (!$permission) {
            return Permission::create(['name' => $name]);
        } else {
            return $permission;
        }
    }

    public function delete(PermissionContract $permission)
    {
        // TODO: Implement delete() method.
        if ($permission instanceof Model) {
            $permission->delete();

            Event::fire(new PermissionWasDeleted($permission));
        }
    }

    public function getPermission($name)
    {
        // TODO: Implement getPermission() method.
        $builder = Permission::query();

        $id = (int) $name;
        if (is_int($id) && $id) {
            $builder->where('id', $id);
        } else {
            $builder->where('name', $name);
        }

        return $builder->first();
    }

    public function getPermissions(array $names = [])
    {
        // TODO: Implement getPermissions() method.
        $builder = Permission::query();
        if (count($names)) {
            $builder->whereIn('name', $names);
        }

        return $builder->get();
    }

    public function getItemPermissions(ItemContract $item)
    {
        // TODO: Implement getItemPermissions() method.
        return Permission::where('item_type', $item->getType())
            ->where('item_id', $item->getId())
            ->get();
    }

    public function hasItemPermission(ItemContract $item, PermissionContract $permission)
    {
        // TODO: Implement hasItemPermission() method.
        return Item::where('item_type', $item->getType())
            ->where('item_id', $item->getId())
            ->where('role_id', $permission->getId())
            ->first() ? true : false;
    }

    public function hasItemPermissionName(ItemContract $item, $name)
    {
        // TODO: Implement hasItemPermissionName() method.
        $permission = $this->getPermission($name);

        return $permission ? $this->hasItemPermission($item, $permission) : false;
    }

    public function assignItemPermission(ItemContract $item, PermissionContract $permission)
    {
        // TODO: Implement assignItemPermission() method.
        if (!$this->hasItemPermission($item, $permission)) {
            Item::insert([
                'item_type' => $item->getType(),
                'item_id'   => $item->getId(),
                'role_id'   => $permission->getId()
            ]);
        }
    }

    public function assignItemPermissionName(ItemContract $item, $name)
    {
        // TODO: Implement assignItemPermissionName() method.
        $permission = $this->getPermission($name);
        if ($permission) {
            $this->assignItemPermission($item, $permission);
        } else {
            throw new NullPointerException("Permission $name could not be found.");
        }
    }

    public function removeItemPermission(ItemContract $item, PermissionContract $permission)
    {
        // TODO: Implement removeItemPermission() method.
        if ($this->hasItemPermission($item, $permission)) {
            Item::where('item_type', $item->getType())
                ->where('item_id', $item->getId())
                ->where('role_id', $permission->getId())
                ->delete();
        }
    }

    public function removeItemPermissionName(ItemContract $item, $name)
    {
        // TODO: Implement removeItemPermissionName() method.
        $permission = $this->getPermission($name);
        if ($permission) {
            $this->removeItemPermission($item, $permission);
        } else {
            throw new NullPointerException("Permission $name could not be found.");
        }
    }

    public function getObjectPermissions(ItemContract $subject, ItemContract $object)
    {
        // TODO: Implement getObjectPermissions() method.
        $rt = $this->getPermissionTable();
        $ot = $this->getPermissionObjectTable();

        return Permission::query()
            ->join($ot, "$ot.role_id", '=', "rt.id")
            ->where("$ot.subject_type", $subject->getType())
            ->where("$ot.subject_id", $subject->getId())
            ->where("$ot.object_type", $object->getType())
            ->where("$ot.object_id", $object->getId())
            ->get();
    }

    public function getSubjectItems($type, ItemContract $object, $withTrashed = false)
    {
        // TODO: Implement getSubjectItems() method.
        $subject = app($type);
        if ($subject instanceof ItemContract) {
            $ot = $this->getPermissionObjectTable();
            $st = $subject->getTable();

            $builder = $subject->query()
                ->join($ot, "$ot.subject_id", '=', "$st.id")
                ->where("$ot.subject_type", $subject->getType())
                ->where("$ot.object_type", $object->getType())
                ->where("$ot.object_id", $object->getId());

            if (!$withTrashed) {
                $builder->whereNull("$st.deleted_at")
                    ->withTrashed();
            }

            return $builder->get([
                "$st.*",
                "$ot.role_id"
            ]);
        }
    }

    public function getObjectItems(ItemContract $subject, $type, $withTrashed = false)
    {
        // TODO: Implement getObjectItems() method.
        $object = app($type);
        if ($object instanceof ItemContract) {
            $ot = $this->getPermissionObjectTable();
            $st = $object->getTable();

            $builder = $object->query()
                ->join($ot, "$ot.object_id", '=', "$st.id")
                ->where("$ot.object_type", $object->getType())
                ->where("$ot.subject_type", $subject->getType())
                ->where("$ot.subject_id", $subject->getId());

            if (!$withTrashed) {
                $builder->whereNull("$st.deleted_at")
                    ->withTrashed();
            }

            return $builder->get([
                "$st.*",
                "$ot.role_id"
            ]);
        }
    }

    public function hasObjectPermission(ItemContract $subject, PermissionContract $permission, ItemContract $object)
    {
        // TODO: Implement hasObjectPermission() method.
        return Object::where('subject_type', $subject->getType())
            ->where('subject_id', $subject->getId())
            ->where('object_type', $object->getType())
            ->where('object_id', $object->getId())
            ->where('role_id', $permission->getId())
            ->first() ? true : false;
    }

    public function hasObjectPermissionName(ItemContract $subject, $name, ItemContract $object)
    {
        // TODO: Implement hasObjectPermissionName() method.
        $permission = $this->getPermission($name);
        if ($permission) {
            return $this->hasObjectPermission($subject, $permission, $object);
        } else {
            throw new NullPointerException("Permission $name could not be found.");
        }
    }

    public function assignObjectPermission(ItemContract $subject, PermissionContract $permission, ItemContract $object)
    {
        // TODO: Implement assignObjectPermission() method.
        if (!$this->hasObjectPermission($subject, $permission, $object)) {
            Object::insert([
                'subject_type' => $subject->getType(),
                'subject_id'   => $subject->getId(),
                'object_type'  => $object->getType(),
                'object_id'    => $object->getId(),
                'role_id'      => $permission->getId()
            ]);
        }
    }

    public function assignObjectPermissionName(ItemContract $subject, $name, ItemContract $object)
    {
        // TODO: Implement assignObjectPermissionName() method.
        $permission = $this->getPermission($name);
        if ($permission) {
            $this->assignObjectPermission($subject, $permission, $object);
        } else {
            throw new NullPointerException("Permission $name could not be found.");
        }
    }

    public function removeObjectPermission(ItemContract $subject, PermissionContract $permission, ItemContract $object)
    {
        // TODO: Implement removeObjectPermission() method.
        if (!$this->hasObjectPermission($subject, $permission, $object)) {
            Object::where('subject_type', $subject->getType())
                ->where('subject_id', $subject->getId())
                ->where('object_type', $object->getType())
                ->where('object_id', $object->getId())
                ->where('role_id', $permission->getId())
                ->delete();
        }
    }

    public function removeObjectPermissionName(ItemContract $subject, $name, ItemContract $object)
    {
        // TODO: Implement removeObjectPermissionName() method.
        $permission = $this->getPermission($name);
        if ($permission) {
            $this->removeObjectPermission($subject, $permission, $object);
        } else {
            throw new NullPointerException("Permission $name could not be found.");
        }
    }
}