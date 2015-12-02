<?php namespace TechExim\Auth\Permission;

use Illuminate\Database\Eloquent\Model;
use TechExim\Auth\Contracts\Permission as Contract;

class Permission extends Model implements Contract
{
    use IsPermission;
}