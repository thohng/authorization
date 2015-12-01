<?php namespace Auth\Role;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function getTable()
    {
        return config('authorization.item.role');
    }
}