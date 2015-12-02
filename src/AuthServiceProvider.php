<?php namespace Auth;

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
        $this->app->singleton('Auth\Contracts\Guard', 'Auth\Guard');
        $this->app->singleton('Auth\Contracts\Role', with(new config('authorization.role.model', 'Auth\Role')));
        $this->app->singleton('Auth\Contracts\Permission', with(new config('authorization.permission.model', 'Auth\Permission')));

        $this->app->bind('Auth\Contracts\Role\Repository', 'Auth\Role\Repository');
        $this->app->bind('Auth\Contracts\Permission\Repository', 'Auth\Permission\Repository');
    }

    public function provides()
    {
        return [
            'Auth\Contracts\Guard',
            'Auth\Contracts\Role',
            'Auth\Contracts\Permission',
            'Auth\Contracts\Role\Repository',
            'Auth\Contracts\Permission\Repository'
        ];
    }
}