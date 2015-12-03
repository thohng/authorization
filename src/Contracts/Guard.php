<?php namespace TechExim\Auth\Contracts;

interface Guard
{
    /**
     * @param Item   $subject
     * @param string $action
     * @param Item   $object
     * @return mixed
     */
    public function hasPermissionTo(Item $subject, $action, Item $object);
}