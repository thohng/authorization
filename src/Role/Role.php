<?php namespace TechExim\Auth\Role;

use Illuminate\Database\Eloquent\Model;
use TechExim\Auth\Contracts\Role as Contract;
use TechExim\Auth\Contracts\Permission\HasPermissions;

class Role extends Model implements Contract, HasPermissions
{
    use IsRole;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}