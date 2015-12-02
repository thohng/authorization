<?php namespace TechExim\Auth\Contracts\Permission;

interface HasPermissions
{
    /**
     * @return mixed
     */
    public function getPermissions();
}