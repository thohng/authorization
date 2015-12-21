<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use TechExim\Auth\Contracts\Permission\Repository as PermissionRepository;
use TechExim\Auth\Contracts\Permission;
use Illuminate\Support\Facades\Event;
use TechExim\Auth\Events\PermissionWasDeleted;
use TechExim\Auth\Contracts\Item;

class PermissionRepositoryTest extends TestCase
{
 //   use DatabaseTransactions;

    protected $sample = 'user.create';

    /**
     * @var PermissionRepository
     */
    protected $repository;

    protected function getRepository()
    {
        if (is_null($this->repository)) {
            $this->repository = app(PermissionRepository::class);
        }

        return $this->repository;
    }

    public function testCreateAndDeletePermission()
    {
        $permission = $this->getRepository()->create($this->sample);
        $this->assertInstanceOf(Permission::class, $permission);
        $permissionId = $permission->getId();
        $this->seeInDatabase('auth_permissions', ['id' => $permissionId]);


        Event::listen(PermissionWasDeleted::class, function($event) use ($permissionId) {
            $this->assertInstanceOf(Permission::class, $event->permission);
            $this->assertEquals($permissionId, $event->permission->getId());
        });

        $this->getRepository()->delete($permission);
        $this->assertNull($this->getRepository()->getPermission($permission->getId()));
    }

    public function testAssignAndHasAndRemoveItemPermission()
    {
        $permission = $this->getRepository()->create($this->sample);
        $item = new MyItem();
        $this->getRepository()->assignItemPermission($item, $permission);
        $this->assertTrue($this->getRepository()->hasItemPermission($item, $permission));

        $this->getRepository()->removeItemPermissionName($item, $this->sample);
        $this->assertFalse($this->getRepository()->hasItemPermissionName($item, $this->sample));
    }

    public function testAssignAndHasAndRemoveObjectPermission()
    {
        $permission = $this->getRepository()->create($this->sample);
        $item = new MyItem();
        $object = new MyObject();

        $this->getRepository()->assignObjectPermission($item, $permission, $object);
        $this->assertTrue($this->getRepository()->hasObjectPermission($item, $permission, $object));

        $this->getRepository()->removeObjectPermission($item, $permission, $object);
        $this->assertFalse($this->getRepository()->hasObjectPermissionName($item, $this->sample, $object));
    }
}