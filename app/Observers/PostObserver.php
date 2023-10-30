<?php

namespace App\Observers;

use App\Models\Post;

class PostObserver
{
    public function creating(Post $post)
    {
        if(!app()->runningInConsole()){ //agregamos esta condicional para que no nos ejecute esto si estamos en consola para que no muestre error
            $post->user_id = auth()->id();
        }
    }

    public function updating(Post $post)
    {
        if ($post->published && !$post->published_at) {
            $post->published_at = now();
        }
    }
}
