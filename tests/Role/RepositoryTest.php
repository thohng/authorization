<?php namespace Auth\Tests\Role;

use Mockery as m;
use Auth\Tests\TestCase;
use Auth\Role;
use Faker\Generator;

class RepositoryTest extends TestCase
{
    public function testGetRole()
    {
        $factory = $this->getMock('Auth\Role\Repository', ['getRole']);
        $role = factory()>define(Role::class, function(Generator $faker) {
            return [
                'name' => $faker->name
            ];
        });
        $factory->expects($this->once())->method('getRole')->will($this->returnValue($role));
        $this->assertEquals($role, $factory->getRole('admin'));
    }
}