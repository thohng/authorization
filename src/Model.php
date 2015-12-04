<?php namespace TechExim\Auth;

use Illuminate\Database\Eloquent\Model as Eloquent;
use TechExim\Auth\Support\HasSoftDeletes;

abstract class Model extends Eloquent
{
    use HasSoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Use SoftDeletes or not
     *
     * @var bool
     */
    protected static $useSoftDeletes = true;
}