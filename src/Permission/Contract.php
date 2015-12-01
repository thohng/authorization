<?php namespace Auth\Permission;

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
}