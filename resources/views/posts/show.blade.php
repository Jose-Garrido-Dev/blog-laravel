<x-app-layout>
    <figure>
        <img src="{{ asset('/img/home/banner.jpg') }}" class="w-full aspect-[3/1] object-cover object-center" alt="">
    </figure>

    <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-4">
            <div class="col-span-3">
                @foreach ($post->tags as $tag)
                <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded">
                    {{$tag->name}}
                </span>
                @endforeach
        
                <h1 class="text-4xl font-semibold">
                    {{$post->title}}
                </h1>
        
                <hr class="mt-1 mb-2 ">
        
                <p class="text-gray-600 mb-6">
                    {{$post->published_at->format('d M Y')}} - {{$post->user->name}}          
                </p>
        
                <figure class="mb-6">
                    <img src="{{$post->image}}" alt="{{$post->title}}" class="w-full aspect-[16/9] object-cover object-center">
                </figure>
        
                <div>
                    {!! $post->body !!}
                </div>
            </div>
            <div class="col-span-1">
                <h2 class="text-2xl text-center font-semibold mt-4 mb-4">
                    Artículos Relacionados
                </h2>

                <hr class="mt-1 mb-2">

                <article class="grid grid-cols-2 gap-1">
                    <figure>
                        <img src="{{$post->image}}" alt="{{$post->title}}">
                    </figure>
                    <div>
                        <h1 class=" font-semibold">
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
                            <div>
                                <a href="{{route('posts.show',$post)}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Leer más</a>
                            </div>
                        </div>
                    </div>
    
                </article>
            </div>
        </div>    



    </section>    
</x-app-layout>