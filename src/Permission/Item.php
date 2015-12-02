<?php namespace TechExim\Auth\Permission;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function getTable()
    {
        return config('authorization.item.permission');
    }
}