<?php namespace TechExim\Auth;

use Illuminate\Support\ServiceProvider as Base;

class AuthServiceProvider extends Base
{
    protected $defer = true;

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/authorization.php' => config_path('authorization.php')
        ], 'config');

        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations')
        ], 'migrations');
    }

    public function register()
    {
        // TODO: Implement register() method.
        $this->app->singleton('TechExim\Auth\Contracts\Guard', 'TechExim\Auth\Guard');
        $this->app->singleton('TechExim\Auth\Contracts\Role', config('authorization.role.model', 'TechExim\Auth\Role\Role'));
        $this->app->singleton('TechExim\Auth\Contracts\Permission', config('authorization.permission.model', 'TechExim\Auth\Permission\Permission'));

        $this->app->bind('TechExim\Auth\Contracts\Role\Repository', 'TechExim\Auth\Role\Repository');
        $this->app->bind('TechExim\Auth\Contracts\Permission\Repository', 'TechExim\Auth\Permission\Repository');
    }

    public function provides()
    {
        return [
            'TechExim\Auth\Contracts\Guard',
            'TechExim\Auth\Contracts\Role',
            'TechExim\Auth\Contracts\Permission',
            'TechExim\Auth\Contracts\Role\Repository',
            'TechExim\Auth\Contracts\Permission\Repository'
        ];
    }
}