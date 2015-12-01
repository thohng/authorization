<?php namespace Auth\Role;

interface HasRoles
{
    /**
     * @return mixed
     */
    public function getRoles();
}