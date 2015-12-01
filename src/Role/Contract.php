<?php namespace Auth\Role;

interface Contract
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @return int
     */
    public function getId();

    /**
     * @return mixed
     */
    public function getPermissions();
}