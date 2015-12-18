## Laravel Authorization Mechanism

This package is a package to provide Roles & Permissions management for any kind of objects, at this moment, it is designed to use for Laravel 5

### Installation
Use composer to download the package
``` shell
composer require techexim/authorization
```

Add Service Provider to Laravel application
``` php
TechExim\Auth\AuthServiceProvider::class,
```

You might need to publish default migrations and configuration
``` shell
php artisan vendor:publish
```

### How to use
#### Guard
Guard is a simple implemented service which provides simplest way to check permission of a subject on an object
``` php
use TechExim\Auth\Contracts\Guard;

class MyController extends Controller
{
	public function postAuth(Guard $guard)
	{
		// Check permissions of a subject
		// Both subject and object must implement TechExim\Auth\Contracts\Item
		$guard->hasPermissionTo($subject, 'section.action', $object);
	}
}
```

#### Roles
``` php
use TechExim\Auth\Contracts\Role\Repository as RoleRepository;

class MyController extends Controller
{
	public function postRole(RoleRepository $roleRepository)
	{
		// Add a new role
		$roleRepository->create('my_role');
	
		// Assign role to an object
		// Object must implement TechExim\Auth\Contracts\Item
		$roleRepository->assignObjectByName('my_role', $object);

		// Assign role to a subject on an object
		// Both subject and object must implement TechExim\Auth\Contracts\Item
		$roleRepository->assignRoleByName($subject, 'my_role', $object);

		// Get all assigned roles of an object
		$roleRepository->getObjectRoles($object);

		// Check if a subject has a particular role on an object
		$roleRepository->hasRoleByName($subject, 'my_role', $object);

		// Remove subject's role on an object
		$roleRepository->removeRoleByName($subject, 'my_role', $object);
	}
}
```

#### Permissions
``` php
use TechExim\Auth\Contracts\Permission\Repository as PermissionRepository;

class MyController extends Controller
{
	public function postPermission(PermissionRepository $permissionRepository)
	{
		// A new permission
		$permissionRepository->create('section.action');

		// Assign permission to a subject on an object
		// Both subject and object must implement TechExim\Auth\Contracts\Item
		$permissionRepository->assignPermissionByName($subject, 'section.action', $object);

		// Check whether a subject has permission on an object
		$permissionRepository->hasPermissionByName($subject, 'section.action', $object);
	}
}
```

### License

The Laravel Authorization is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)