<?php namespace Auth\Contracts\Role;

interface HasRoles
{
    /**
     * @return mixed
     */
    public function getRoles();
}