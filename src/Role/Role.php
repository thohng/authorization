<?php namespace TechExim\Auth\Role;

use TechExim\Auth\Model;
use TechExim\Auth\Contracts\Role as Contract;
use TechExim\Auth\Contracts\Permission\HasPermissions;

class Role extends Model implements Contract, HasPermissions
{
    use IsRole;
}