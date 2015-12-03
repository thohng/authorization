<?php namespace TechExim\Auth\Permission;

use TechExim\Auth\Model;

class Item extends Model
{
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

    public function getTable()
    {
        return config('authorization.item.permission', 'auth_permission_items');
    }
}