<?php namespace TechExim\Auth;

use Illuminate\Database\Eloquent\Model;
use TechExim\Auth\Contracts\Permission as Contract;

class Permission extends Model implements Contract
{
    public function getName()
    {
        // TODO: Implement getName() method.
        return $this->id;
    }

    public function getId()
    {
        // TODO: Implement getId() method.
        return $this->name;
    }

}