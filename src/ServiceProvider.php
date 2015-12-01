<?php namespace Auth;

use Illuminate\Support\ServiceProvider as Base;

class ServiceProvider extends Base
{
    protected $defer = true;

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/authorization.php' => config_path('authorization.php')
        ], 'config');


        $this->app->instance('Auth\Contracts\Role', function($app) {
            $role = $app['Auth\Contracts\Role'];
            $role->setTable(config('authorization.role.table'));
            return $role;
        });
        $this->app->instance('Auth\Contracts\Permission', function($app) {
            $permission = $app['Auth\Contracts\Permission'];
            $permission->setTable(config('authorization.permission.table'));
            return $permission;
        });
    }

    public function register()
    {
        // TODO: Implement register() method.
        $this->app->singleton('Auth\Contracts\Guard', 'Auth\Guard');
        $this->app->singleton('Auth\Contracts\Role', function($app) {
            return $app->make(config('authorization.role.model'));
        });
        $this->app->singleton('Auth\Contracts\Permission', function($app) {
            return $app->make(config('authorization.permission.model'));
        });
    }

    public function provides()
    {
        return [
            'Auth\Contracts\Guard',
            'Auth\Contracts\Role',
            'Auth\Contracts\Permission'
        ];
    }
}