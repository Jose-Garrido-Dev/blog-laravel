<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


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
  

                // Verifica si el usuario tiene el correo 'admin@bytewise.com'
        // y asigna todos los permisos si es el caso
        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            // Verifica si el usuario tiene el correo 'admin@bytewise.com'
            if ($user->email === 'admin@bytewise.com') {
                // Asigna el rol 'Admin' al usuario si no lo tiene
                $adminRole = Role::findOrCreate('Admin', 'web');
                if (!$user->hasRole($adminRole)) {
                    $user->assignRole($adminRole);
                }

                // Asigna todos los permisos al usuario si no los tiene
                $permissions = Permission::all();
                if (!$user->hasAnyPermission($permissions)) {
                    $user->syncPermissions($permissions);
                }

                // Aprueba la solicitud
                return true;
            }

            return null;
        });
        
    }
}
