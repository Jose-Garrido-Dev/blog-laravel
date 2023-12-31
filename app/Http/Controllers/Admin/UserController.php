<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users= User::paginate();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */


    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {

        $roles= Role::all();
        return view('admin.users.edit', compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
   


        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|string|email|max:255|unique:users,email,{$user->id}",
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if($user->password){
            $user->password = bcrypt($request->password);
        }

        $user->save();
        
        $user->roles()->sync($request->roles);



        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'El usuario se actualizó correctamente.',
        ]);

        return redirect()->route('admin.users.edit',$user);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Asigna el rol de Blogger al usuario recién creado
        $bloggerRole = Role::where('name', 'blogger')->first();
        $user->assignRole($bloggerRole);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'El usuario se creó correctamente y se le asignó el rol de Blogger.',
        ]);

        return redirect()->route('admin.users.edit', $user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
