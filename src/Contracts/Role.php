<?php namespace Auth\Contracts;

interface Role
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