<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use TechExim\Auth\Contracts\Role\Repository as RoleRepository;
use TechExim\Auth\Contracts\Role;
use Illuminate\Support\Facades\Event;
use TechExim\Auth\Events\RoleWasDeleted;
use TechExim\Auth\Contracts\Item;

class RoleRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    protected $sample = 'subscriber';

    /**
     * @var RoleRepository
     */
    protected $repository;

    protected function getRepository()
    {
        if (is_null($this->repository)) {
            $this->repository = app(RoleRepository::class);
        }

        return $this->repository;
    }

    public function testCreateAndDeleteRole()
    {
        $role = $this->getRepository()->create($this->sample);
        $this->assertInstanceOf(Role::class, $role);
        $roleId = $role->getId();
        $this->seeInDatabase('auth_roles', ['id' => $roleId]);


        Event::listen(RoleWasDeleted::class, function($event) use ($roleId) {
            $this->assertInstanceOf(Role::class, $event->role);
            $this->assertEquals($roleId, $event->role->getId());
        });

        $this->getRepository()->delete($role);
        $this->assertNull($this->getRepository()->getRole($role->getId()));
    }

    public function testAssignAndHasAndRemoveItemRole()
    {
        $role = $this->getRepository()->create($this->sample);
        $item = new MyItem();
        $this->getRepository()->assignItemRole($item, $role);
        $this->assertTrue($this->getRepository()->hasItemRole($item, $role));

        $this->getRepository()->removeItemRoleName($item, $this->sample);
        $this->assertFalse($this->getRepository()->hasItemRoleName($item, $this->sample));
    }

    public function testAssignAndHasAndRemoveObjectRole()
    {
        $role = $this->getRepository()->create($this->sample);
        $item = new MyItem();
        $object = new MyObject();

        $this->getRepository()->assignObjectRole($item, $role, $object);
        $this->assertTrue($this->getRepository()->hasObjectRole($item, $role, $object));

        $this->getRepository()->removeObjectRole($item, $role, $object);
        $this->assertFalse($this->getRepository()->hasObjectRoleName($item, $this->sample, $object));
    }
}

class MyItem implements Item
{
    protected $id;

    public function __construct()
    {
        $this->id = rand(1, 10);
    }

    public function getType()
    {
        // TODO: Implement getType() method.
        return 'my_item';
    }

    public function getId()
    {
        // TODO: Implement getId() method.
        return $this->id;
    }
}

class MyObject implements Item
{
    protected $id;

    public function __construct()
    {
        $this->id = rand(1, 10);
    }

    public function getType()
    {
        // TODO: Implement getType() method.
        return 'my_object';
    }

    public function getId()
    {
        // TODO: Implement getId() method.
        return $this->id;
    }
}