<?php namespace TechExim\Auth\Permission;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function getTable()
    {
        return config('authorization.item.permission');
    }
}