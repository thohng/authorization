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
        $modelRole = config('authorization.role.model', 'TechExim\Auth\Role');
        $modelPermission = config('authorization.permission.model', 'TechExim\Auth\Permission');
        
        $this->app->singleton('TechExim\Auth\Contracts\Guard', 'TechExim\Auth\Guard');
        $this->app->singleton('TechExim\Auth\Contracts\Role', with(new $modelRole));
        $this->app->singleton('TechExim\Auth\Contracts\Permission', with(new $modelPermission));

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