<?php namespace TechExim\Auth\Permission;

use Illuminate\Database\Eloquent\Model;
use TechExim\Auth\Contracts\Permission as Contract;

class Permission extends Model implements Contract
{
    use IsPermission;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}