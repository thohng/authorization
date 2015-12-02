<?php namespace TechExim\Auth\Contracts\Role;

interface HasRoles
{
    /**
     * @return mixed
     */
    public function getRoles();
}