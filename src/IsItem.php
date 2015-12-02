<?php namespace TechExim\Auth;

trait IsItem
{
    public function getId()
    {
        return $this->id;
    }

    public function getType()
    {
        $args = explode('\\', get_class());
        return strtolower(array_pop($args));
    }
}