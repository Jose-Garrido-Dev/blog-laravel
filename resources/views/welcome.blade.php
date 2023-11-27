<x-app-layout>

    <figure>
        <img src="{{ asset('/img/home/banner.jpg') }}" class="w-full aspect-[3/1] object-cover object-center" alt="">
    </figure>
    

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl text-center font-semibold mt-4 mb-4">
            Lista de Artículos
        </h1>

        <div class="grid grid-cols-4">
            <div class="col-span-1">
                <form action="{{route('home')}}">
                    <div class="mb-4">
                        <p class="text-lg font-semibold">Ordenar : </p>

                        <select name="order" class="border-gray-300  focus:border-indigo-500  focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="new">Mas nuevos</option>
                            <option value="old" @selected(request('order') == 'old')>Mas antiguos</option>
                        </select>           
                    </div>
                    <div>
                        <p class="text-lg font-semibold">Categorías : </p> 
                        <ul>
                            @foreach ($categories as $category)
                                <li>
                                    <label class="">
                                        <x-checkbox name="category[]" value="{{$category->id}}" :checked="in_array($category->id, request('category') ?? [])" />
                                        <span class="ml-2 text-gray-700">{{$category->name}}</span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>      
                    </div>
                    <x-button>
                        Filtrar
                    </x-button>

                </form>
            </div>

            <div class="col-span-3">
                <div class="space-y-8">
                    @foreach ($posts as $post)
                    <article class="grid grid-cols-2 gap-6">
                        <figure>
                            <img src="{{$post->image}}" alt="{{$post->title}}">
                        </figure>
                        <div>
                            <h1 class="text-xl font-semibold">
                                {{$post->title}}
                            </h1>
                            <hr class="mt-1 mb-2">
                            <div class="mb-2">
                                @foreach($post->tags as $tag)
                                    <a href="{{route('home') . '?tag=' . $tag->name}}">
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded ">                           
                                            {{ $tag->name}}
                                        </span>
                                    </a>

                                @endforeach
                                <p class="text-sm mb-2">
                                    {{$post->published_at->format('d M Y')}}
                                </p>
                                <div class="mb-4">
                                    {{ Str::limit($post->excerpt,100,'...')}}
                                </div>
                                <div>
                                    <a href="{{route('posts.show',$post)}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Leer más</a>
                                </div>
                            </div>
                        </div>
        
                    </article>
                    @endforeach
                </div>
                <div class="mt-4 mb-6">
                    {{$posts->links()}}
                </div>
            </div>
        </div>


    </section>

</x-app-layout>