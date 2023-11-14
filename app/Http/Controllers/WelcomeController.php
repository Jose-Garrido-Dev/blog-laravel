<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;


class WelcomeController extends Controller
{
    public function __invoke(){

        $posts= Post::where('published', true)
                    ->orderBy('published_at', 'desc')
                    ->paginate(10);

        // como solo retorna a la vista no es necesario crear metodo index
        return view('welcome',compact('posts'));
    }
}
