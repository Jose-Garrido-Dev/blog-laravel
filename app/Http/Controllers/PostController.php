<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function image(Post $post){
        /* $image = Storage::get($post->image_path);

        return response($image)
            ->header('Content-Type', 'image/jpeg'); */

        return Storage::temporaryUrl(
            $post->image_path,
            now()->addMinutes(5)
        );
    }

    public function show(Post $post){

        $relatedPosts = Post::whereHas('tags', function ($query) use ($post) {
            $query->whereIn('tags.id', $post->tags->pluck('id'));
        })
        ->where('id', '!=', $post->id)
        ->take(5) // Puedes ajustar la cantidad de artículos relacionados que deseas mostrar
        ->get();

        return view('posts.show',compact('post','relatedPosts'));
    }
}
