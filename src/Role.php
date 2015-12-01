<?php namespace Auth;

use Illuminate\Database\Eloquent\Model;
use Auth\Contracts\Role as Contract;
use Auth\Contracts\Permission\HasPermissions;

class Role extends Model implements Contract, HasPermissions
{
    public function getName()
    {
        // TODO: Implement getName() method.
        return $this->name;
    }

    public function getId()
    {
        // TODO: Implement getId() method.
        return $this->id;
    }

    public function getPermissions()
    {
        // TODO: Implement getPermissions() method.
        return $this->permissions;
    }

    public function permissions()
    {
        $model = config('authorization.permission.model');
        $table = config('authorization.role.permissions');
        return $this->belongsToMany($model, $table, 'role_id', 'permission_id');
    }
}