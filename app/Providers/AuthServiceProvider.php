<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //gates esta gates no la utilizaremos ya que reemplazaremos por laravel permission
     /*   Gate::define('admin', function ($user){
          //  return $user->role === 'admin';
            return $user->is_admin;
        });*/

        //para que otros autores no puedan editar posts que no son de ellos se va este gate a la policy post


    }
}
