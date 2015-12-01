<?php namespace Auth\Contracts;

interface Permission
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @return int
     */
    public function getId();
}