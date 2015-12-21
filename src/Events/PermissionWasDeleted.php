<?php namespace TechExim\Auth\Events;

use TechExim\Auth\Contracts\Permission;
use Illuminate\Queue\SerializesModels;

class PermissionWasDeleted
{
    use SerializesModels;

    /**
     * @var Permission
     */
    public $permission;

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }
}