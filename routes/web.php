<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\PostController;
use App\Models\Image;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\WelcomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', WelcomeController::class,)->name('home'); // como usamos metodo invoke en controller no necesitamos pasarle el metodo al controller

Route::get('posts/{post}',[PostController::class,'show'])->name('posts.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/posts/{post}/image', [PostController::class, 'image'])
    ->name('posts.image');

Route::post('images/upload', [ImageController::class, 'upload'])
    ->name('images.upload');
/*
Route::get('prueba', function(){
    $files = Storage::files('images');  // este metodo me trae solo los archivos que se encuentran en la carpeta pero ignora subcarpetas y sus archivos si le pongo allfiles trae todo hasta los que estan en subcarpetas
    $images = Image::pluck('path')->toArray();
// return Storage::downlodad('posts/articulo-de-prueba.png') y listo lo descarga ´podemos agregar un return para gacero mas visual, si no pedimos que lo retrone no hara nada
    
    Storage::delete(array_diff($files, $images));
});*/