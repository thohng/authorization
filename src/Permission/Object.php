<?php namespace TechExim\Auth\Permission;

use TechExim\Auth\Model;
use TechExim\Support\HasMultipleKeys;

class Object extends Model
{
    use HasMultipleKeys;

    /**
     * The primary keys for the model.
     *
     * @var array
     */
    protected $primaryKey = [
        'permission_id',
        'subject_type',
        'subject_id',
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
        return config('authorization.permission.objects', 'auth_permission_objects');
    }
}