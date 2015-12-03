<?php namespace TechExim\Auth\Permission;

use TechExim\Auth\Model;

class Item extends Model
{
    public function getTable()
    {
        return config('authorization.item.permission', 'auth_permission_items');
    }
}