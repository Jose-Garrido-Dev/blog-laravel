<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'excerpt',
        'body',
        'user_id',
        'published',
        'image_path'
    ];

    protected $casts =[
        
        //'published' => 'true',
        'published_at' => 'datetime'
    ];
//Accesores y mutadores
    protected function title(): Attribute
    {
        return new Attribute(
            set: fn ($value) => strtolower($value), //mutadorescon el metodo set almacenamos un mutador para que se almacenen en nuestra base de datos, le decimos que lo almacene en minuscula,
            get: fn ($value) => ucfirst($value)   // accesores recuperamos lo que sea de la base  de datos y lo transoformamos como nosotros queramos con ucfirst le decimos que transforme la prmera letra en mayuscula
        );
    }
//agregamos propiedad que no exuste en la tabla con un accesor , definiendo propiedad protegida, dandole funcion y un nombre
    protected function image(): Attribute
    {
        return new Attribute(
            /* get: fn () => $this->image_path ?? 'https://t4.ftcdn.net/jpg/04/73/25/49/360_F_473254957_bxG9yf4ly7OBO5I0O5KABlN930GwaMQz.jpg'  existe imagen trae la imagen sino trae la url que te pasamos*/

            get: function(){
                if($this->image_path){

                    if (substr($this->image_path, 0, 8) === 'https://') {
                        return $this->image_path;
                    }

                    return Storage::url($this->image_path);

                    /* return route('posts.image', $this); */

                    /* return Storage::temporaryUrl(
                        $this->image_path,
                        now()->addMinutes(5)
                    ); */

                }else{
                    return 'https://t4.ftcdn.net/jpg/04/73/25/49/360_F_473254957_bxG9yf4ly7OBO5I0O5KABlN930GwaMQz.jpg';
                }
            }

        );
    }


    //Relacion uno a uno inversa
    public function category(){
        return $this->belongsTo(Category::class);
    }

    //Relacion uno a muchos inversa
    public function user(){
        return $this->belongsTo(User::class);
    }

    //Relacion uno a muchos polimorfica
    public function comments(){
        return $this->morphMany(Comment::class, 'commentable');
    }
    //Relacion uno a muchos polimorfica
    public function images(){
        return $this->morphMany(Image::class, 'imageable');
    }

    //Relacion muchos a muchos polimorfica
    public function tags(){
        return $this->morphToMany(Tag::class, 'taggable');
    }

    //Relación de uno a muchos polimórfica
    public function questions()
    {
        return $this->morphMany(Question::class, 'questionable');
    }

    //Route Model Binding

    public function getRouteKeyName()
    {
        return 'slug';
    }


    // se crea metodo que recibela consulta un queryscope
    public function scopefilter($query, $filters){
        $query->when($filters['category'] ?? null, function($query,$category){
            $query->whereIn('category_id',$category);
        })->when($filters['order'] ?? 'new', function($query,$order){
            
            $sort = $order === 'new' ? 'desc' : 'asc';
            $query->orderBy('published_at', $sort);
        })->when($filters['tag'] ?? null,function($query,$tag){
            $query->whereHas('tags',function($query) use($tag){
                $query->where('tags.name', $tag);
            });
        });

    }
// esta es un queryscope global con esto le decimos si es administrador relice la consulta
    protected static function booted(){
        static::addGlobalScope('written', function($query){
            if(request()->routeIs('admin.*')){
                $query->where('user_id', auth()->id());
            }
        });
    }
}
