<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){

    return view('admin.dashboard');
    
})->middleware('can:Acceso al Dashboard')
  ->name('dashboard');

//Rutas de Usuarios

Route::resource('/categories', CategoryController::class)
    ->middleware('can:Gestion categorias')
    ->except('show');

Route::resource('/posts', PostController::class)
    ->middleware('can:Gestion Articulos')
    ->except('show');


Route::resource('/roles', RoleController::class)
                ->middleware('can:Gestion Roles')
                ->except('show');
                
Route::resource('/permissions', PermissionController::class)
            ->middleware('can:Gestion permisos')
            ->except('show');

Route::resource('/users', UserController::class)
            ->middleware('can:Gestion Usuarios')
            ->except(['show','create','store']);