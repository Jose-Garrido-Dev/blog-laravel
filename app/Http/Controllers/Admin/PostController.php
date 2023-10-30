<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\ResizeImage;
use App\Models\Category;
use App\Models\Image;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::where('user_id', auth()->id())
            ->latest('id')
            ->paginate(10);

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:posts',
            'category_id' => 'required|exists:categories,id',
        ]);

        $post = Post::create($request->all());

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'El post se creó correctamente.',
        ]);

        return redirect()->route('admin.posts.edit', $post);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if(!Gate::allows('author', $post)){
            abort(403,'No tienes permiso para editar este Post');
        }

        //$this->authorize('author', $post);

        $categories = Category::all();

        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {

        /*return $request->all();*/
        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:posts,slug,' . $post->id, // con esto le decimos que excluya el slug  que estamos editando  y no muestre problemas al validar 
            'category_id' => 'required|exists:categories,id',
            'excerpt' => $request->published ? 'required' : 'nullable',
            'body' => $request->published ? 'required' : 'nullable',// tambien validamos que no publique articulos cuando le falta el cuerpo o extract
            'published' => 'required|boolean',
            'tags' => 'nullable|array', // el tags puede ser nulo si existe puede ser un array
            'image' => 'nullable|image'
        ]);

        $old_images = $post->images->pluck('path')->toArray();

        $re_extractImages = '/src=["\']([^ ^"^\']*)["\']/ims';
        preg_match_all($re_extractImages, $request->body, $matches);
        $images = $matches[1];

        foreach ($images as $key => $image) {
            $images[$key] = 'images/' . pathinfo($image, PATHINFO_BASENAME);
        }

        $new_images = array_diff($images, $old_images);
        $deleted_images = array_diff($old_images, $images);

        foreach ($new_images as $image) {
            $post->images()->create([
                'path' => $image,
            ]);
        }

        foreach ($deleted_images as $image) {
            Storage::delete($image);
            Image::where('path', $image)->delete();
        }

        $data = $request->all();

        $tags = [];

        foreach($request->tags ?? [] as $name)
        {
            $tag = Tag::firstOrCreate([
                'name' => $name,
            ]);

            $tags[] = $tag->id;
        }

        $post->tags()->sync($tags); // aqui sincronizamos el nuevo tag con el post creado

        if($request->file('image')) //aqui subimos un archivo con facade storage , es importantye ene l modelo habilitar asignacion masiva en fillable
        {
            if($post->image_path){
                Storage::delete($post->image_path);
            }

            $file_name = $request->slug . '.' . $request->file('image')->getClientOriginalExtension();// aqui le asignamos el slug de nombre al archivo de imagen, concatenado la extension extraida de la imagen original
            $data['image_path'] = Storage::putFileAs('posts', $request->image, $file_name, 'public'); //al subir imagenes con este metodo putfileas le pasamos carpeta donde quiero que se almacene , el segundo el nombre de la imagen, el tercer parametro 

            //storage/posts/imagen.jpg
            // aqui llamamos al jobs creado para redimensionar imagen
            ResizeImage::dispatch($data['image_path']);

            /* $data['image_path'] = $request->file('image')->storeAs('posts', $file_name, [
                'visibility' => 'public',
            ]); */
        }

        $post->update($data);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'El post se actualizó correctamente.',
        ]);

        return redirect()->route('admin.posts.edit', $post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'El post se eliminó correctamente.',
        ]);

        return redirect()->route('admin.posts.index');
    }
}
