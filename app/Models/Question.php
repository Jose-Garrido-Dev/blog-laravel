<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['body', 'user_id'];

    //relación uno a muchos
    public function answers(){
        return $this->hasMany(Answer::class);
    }
    //relación uno a muchos inversa
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function questionable(){
        return $this->MorphTo();
    }
}
