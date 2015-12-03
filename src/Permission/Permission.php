<?php namespace TechExim\Auth\Permission;

use TechExim\Auth\Model;
use TechExim\Auth\Contracts\Permission as Contract;

class Permission extends Model implements Contract
{
    use IsPermission;
}