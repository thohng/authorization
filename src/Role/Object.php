<?php namespace TechExim\Auth\Role;

use TechExim\Auth\Model;
use TechExim\Auth\Support\HasMultipleKeys;

class Object extends Model
{
    use HasMultipleKeys;

    /**
     * The primary keys for the model.
     *
     * @var array
     */
    protected $primaryKey = [
        'role_id',
        'object_type',
        'object_id'
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
        return config('authorization.role.object', 'auth_role_objects');
    }
}