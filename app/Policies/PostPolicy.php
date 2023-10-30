<?php

namespace App\Policies;
use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    //para que otros autores no puedan editar posts que no son de ellos
    public function author(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }

}
