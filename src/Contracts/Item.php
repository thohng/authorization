<?php namespace Auth\Contracts;

interface Item
{
    /**
     * @return string
     */
    public function getType();

    /**
     * @return int
     */
    public function getId();
}