<?php namespace TechExim\Auth\Role;

use Illuminate\Support\Facades\Event;
use TechExim\Auth\Contracts\Role\Repository as Contract;
use TechExim\Auth\Contracts\Item as ItemContract;
use TechExim\Auth\Contracts\Role as RoleContract;
use TechExim\Auth\Contracts\Permission as PermissionContract;
use TechExim\Auth\Events\RoleWasDeleted;
use Illuminate\Database\Eloquent\Model;
use TechExim\Exception\NullPointerException;

class Repository implements Contract
{
    /**
     * @return string
     */
    private function getRoleTable()
    {
        return app(Role::class)->getTable();
    }

    /**
     * @return string
     */
    private function getRoleItemTable()
    {
        return app(Item::class)->getTable();
    }

    /**
     * @return string
     */
    private function getRoleObjectTable()
    {
        return app(Object::class)->getTable();
    }

    public function create($name)
    {
        // TODO: Implement create() method.
        $role = $this->getRole($name);
        if (!$role) {
            return Role::create(['name' => $name]);
        } else {
            return $role;
        }
    }

    public function delete(RoleContract $role)
    {
        // TODO: Implement delete() method.
        if ($role instanceof Model) {
            $role->delete();
        }

        Event::fire(new RoleWasDeleted($role));
    }

    public function getRole($name)
    {
        // TODO: Implement getRole() method.
        $builder = Role::query();

        $id = (int) $name;
        if (is_int($id) && $id) {
            $builder->where('id', $id);
        } else {
            $builder->where('name', $name);
        }

        return $builder->first();
    }

    public function getRoles(array $names = [])
    {
        // TODO: Implement getRoles() method.
        $builder = Role::query();
        if (count($names)) {
            $builder->whereIn('name', $names);
        }

        return $builder->get();
    }

    public function getItemRoles(ItemContract $item)
    {
        // TODO: Implement getItemRoles() method.
        return Role::where('item_type', $item->getType())
            ->where('item_id', $item->getId())
            ->get();
    }

    public function hasItemRole(ItemContract $item, RoleContract $role)
    {
        // TODO: Implement hasItemRole() method.
        return Item::where('item_type', $item->getType())
            ->where('item_id', $item->getId())
            ->where('role_id', $role->getId())
            ->first() ? true : false;
    }

    public function hasItemRoleName(ItemContract $item, $name)
    {
        // TODO: Implement hasItemRoleName() method.
        $role = $this->getRole($name);

        return $role ? $this->hasItemRole($item, $role) : false;
    }

    public function assignItemRole(ItemContract $item, RoleContract $role)
    {
        // TODO: Implement assignItemRole() method.
        if (!$this->hasItemRole($item, $role)) {
            Item::insert([
                'item_type' => $item->getType(),
                'item_id'   => $item->getId(),
                'role_id'   => $role->getId()
            ]);
        }
    }

    public function assignItemRoleName(ItemContract $item, $name)
    {
        // TODO: Implement assignItemRoleName() method.
        $role = $this->getRole($name);
        if ($role) {
            $this->assignItemRole($item, $role);
        } else {
            throw new NullPointerException("Role $name could not be found.");
        }
    }

    public function removeItemRole(ItemContract $item, RoleContract $role)
    {
        // TODO: Implement removeItemRole() method.
        if ($this->hasItemRole($item, $role)) {
            Item::where('item_type', $item->getType())
                ->where('item_id', $item->getId())
                ->where('role_id', $role->getId())
                ->delete();
        }
    }

    public function removeItemRoleName(ItemContract $item, $name)
    {
        // TODO: Implement removeItemRoleName() method.
        $role = $this->getRole($name);
        if ($role) {
            $this->removeItemRole($item, $role);
        } else {
            throw new NullPointerException("Role $name could not be found.");
        }
    }

    public function getObjectRoles(ItemContract $subject, ItemContract $object)
    {
        // TODO: Implement getObjectRoles() method.
        $rt = $this->getRoleTable();
        $ot = $this->getRoleObjectTable();

        return Role::query()
            ->join($ot, "$ot.role_id", '=', "$rt.id")
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
            $ot = $this->getRoleObjectTable();
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
            $ot = $this->getRoleObjectTable();
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

    public function hasObjectRole(ItemContract $subject, RoleContract $role, ItemContract $object)
    {
        // TODO: Implement hasObjectRole() method.
        return Object::where('subject_type', $subject->getType())
            ->where('subject_id', $subject->getId())
            ->where('object_type', $object->getType())
            ->where('object_id', $object->getId())
            ->where('role_id', $role->getId())
            ->first() ? true : false;
    }

    public function hasObjectRoleName(ItemContract $subject, $name, ItemContract $object)
    {
        // TODO: Implement hasObjectRoleName() method.
        $role = $this->getRole($name);
        if ($role) {
            return $this->hasObjectRole($subject, $role, $object);
        } else {
            throw new NullPointerException("Role $name could not be found.");
        }
    }

    public function assignObjectRole(ItemContract $subject, RoleContract $role, ItemContract $object)
    {
        // TODO: Implement assignObjectRole() method.
        if (!$this->hasObjectRole($subject, $role, $object)) {
            Object::insert([
                'subject_type' => $subject->getType(),
                'subject_id'   => $subject->getId(),
                'object_type'  => $object->getType(),
                'object_id'    => $object->getId(),
                'role_id'      => $role->getId()
            ]);
        }
    }

    public function assignObjectRoleName(ItemContract $subject, $name, ItemContract $object)
    {
        // TODO: Implement assignObjectRoleName() method.
        $role = $this->getRole($name);
        if ($role) {
            $this->assignObjectRole($subject, $role, $object);
        } else {
            throw new NullPointerException("Role $name could not be found.");
        }
    }

    public function removeObjectRole(ItemContract $subject, RoleContract $role, ItemContract $object)
    {
        // TODO: Implement removeObjectRole() method.
        if ($this->hasObjectRole($subject, $role, $object)) {
            Object::where('subject_type', $subject->getType())
                ->where('subject_id', $subject->getId())
                ->where('object_type', $object->getType())
                ->where('object_id', $object->getId())
                ->where('role_id', $role->getId())
                ->delete();
        }
    }

    public function removeObjectRoleName(ItemContract $subject, $name, ItemContract $object)
    {
        // TODO: Implement removeObjectRoleName() method.
        $role = $this->getRole($name);
        if ($role) {
            $this->removeObjectRole($subject, $role, $object);
        } else {
            throw new NullPointerException("Role $name could not be found.");
        }
    }
}