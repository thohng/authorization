<?php namespace TechExim\Auth\Support;

trait HasSoftDeletes
{
    /**
     * Boot the soft deleting trait for a model.
     *
     * @return void
     */
    public static function bootSoftDeletes()
    {
        if (static::$useSoftDeletes) {
            static::addGlobalScope(new SoftDeletingScope);
        }
    }
}