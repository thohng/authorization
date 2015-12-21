<?php namespace TechExim\Auth\Events;

use TechExim\Auth\Contracts\Role;
use Illuminate\Queue\SerializesModels;

class RoleWasDeleted
{
    use SerializesModels;

    /**
     * @var Role
     */
    public $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }
}