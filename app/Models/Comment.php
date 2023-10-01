<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function user(){ //relación uno a muchos inversa
        return $this->belongsTo(User::class);
    }

    //Relacion uno a muchos polimorfica
    public function images(){
        return $this->morphMany(Image::class, 'imageable');
    }

    //Relacion polimorfica
    public function commentable(){
        return $this->morphTo();
    }
}
