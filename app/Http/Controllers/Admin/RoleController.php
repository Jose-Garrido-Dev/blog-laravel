<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;  // este es un modelo creado por paquete laravel permission de spatie

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles =  Role::all();
        return view('admin.roles.index' , compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:roles,name'],   // le decimos que sea unico el nombre y que se valide en el campo name
            'permissions' => 'nullable|array',

        ]);

        $role = Role::create($request->all());
        //sincronización de roles con permisos  puede ser con sync o con attach
        $role->permissions()->attach($request->input('permission')); 

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'El rol se creó correctamente.',
        ]);

        return redirect()->route('admin.roles.edit', $role);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {

        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {

       // $permissions = $role->permissions->pluck('id')->toArray();

        //dd(in_array(1, $permissions));

        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {

        $request->validate([
            'name' => ['required', 'unique:roles,name,' . $role->id],
            'permissions' => 'nullable|array',
        ]);
        $role->update($request->all());
        //sincronización de roles con permisos
        $role->permissions()->sync($request->input('permission'));


        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'El rol se actualizó correctamente.',
        ]);

        return redirect()->route('admin.roles.edit', $role);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'El rol se eliminó correctamente.',
        ]);

        return redirect()->route('admin.roles.index');
    }
}
