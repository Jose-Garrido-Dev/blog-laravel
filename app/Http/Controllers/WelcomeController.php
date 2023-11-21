<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;


class WelcomeController extends Controller
{
    public function __invoke(){

        $categories= Category::all();

        $posts= Post::where('published', true)
                    ->orderBy('published_at', 'desc')
                    ->orderBy('id', 'desc')
                    ->paginate(10);

        // como solo retorna a la vista no es necesario crear metodo index
        return view('welcome',compact('posts','categories'));
    }
}
