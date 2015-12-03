<?php namespace TechExim\Auth\Role;

use TechExim\Auth\Model;

class Item extends Model
{
    public function getTable()
    {
        return config('authorization.item.role', 'auth_role_items');
    }
}