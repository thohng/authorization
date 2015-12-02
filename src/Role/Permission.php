<?php namespace TechExim\Auth\Role;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function getTable()
    {
        return config('authorization.role.permissions');
    }
}