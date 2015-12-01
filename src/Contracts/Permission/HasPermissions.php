<?php namespace Auth\Contracts\Permission;

interface HasPermissions
{
    /**
     * @return mixed
     */
    public function getPermissions();
}