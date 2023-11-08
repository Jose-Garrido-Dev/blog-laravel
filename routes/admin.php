<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){

    return view('admin.dashboard');
    
})->middleware('can:acceso dashboard')
  ->name('dashboard');

//Rutas de Usuarios

Route::resource('/categories', CategoryController::class)
   ->middleware('can:acceso categorias')
    ->except('show');

Route::resource('/posts', PostController::class)
    ->middleware('can:acceso articulos')
    ->except('show');


Route::resource('/roles', RoleController::class)
                ->middleware('can:acceso roles')
                ->except('show');
                
Route::resource('/permissions', PermissionController::class)
            ->middleware('can:acceso permisos')
            ->except('show');

Route::resource('/users', UserController::class)
            ->middleware('can:acceso usuarios')
            ->except(['show','create','store']);