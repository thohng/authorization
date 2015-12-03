<?php namespace TechExim\Auth\Role;

use TechExim\Auth\Model;

class Item extends Model
{
    /**
     * The primary keys for the model.
     *
     * @var array
     */
    protected $primaryKey = [
        'role_id',
        'subject_type',
        'subject_id',
        'object_type',
        'object_id'
    ];

    public function getTable()
    {
        return config('authorization.item.role', 'auth_role_items');
    }
}