<?php namespace TechExim\Auth\Role;

use TechExim\Auth\Model;
use TechExim\Support\HasMultipleKeys;

class Item extends Model
{
    use HasMultipleKeys;

    /**
     * The primary keys for the model.
     *
     * @var array
     */
    protected $primaryKey = [
        'role_id',
        'item_type',
        'item_id'
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
        return config('authorization.role.items', 'auth_role_items');
    }
}