<?php namespace TechExim\Auth\Role;

use TechExim\Auth\Model;

class Object extends Model
{
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

    public function getTable()
    {
        return config('authorization.role.object', 'auth_role_objects');
    }
}