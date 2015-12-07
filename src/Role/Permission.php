<?php namespace TechExim\Auth\Role;

use TechExim\Auth\Model;
use TechExim\Support\HasMultipleKeys;

class Permission extends Model
{
    use HasMultipleKeys;
    
    /**
     * The primary keys for the model.
     *
     * @var array
     */
    protected $primaryKey = [
        'role_id',
        'permission_id'
    ];

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    protected static $useSoftDeletes = false;

    public function getTable()
    {
        return config('authorization.role.permissions', 'auth_role_permissions');
    }
}