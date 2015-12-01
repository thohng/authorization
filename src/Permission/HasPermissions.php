<?php namespace Auth\Permission;

interface HasPermissions
{
    /**
     * @return mixed
     */
    public function getPermissions();
}