<x-app-layout>
    <figure class="mt-1">
        <img src="{{ asset('/img/home/banner.jpg') }}" class="w-full aspect-[3/1] object-cover object-center" alt="">
    </figure>
        <!--detalle de post-->
    <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 sm:grid-cols-4 ">
            <div class="col-span-4 sm:col-span-3">
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
                    <img src="{{$post->image}}" alt="{{$post->title}}" class="w-full aspect-[16/9] object-cover object-center rounded-lg shadow-xl">
                </figure>
        
                <div class="mb-16">
                    {!! $post->body !!}
                </div>
                <div>
                    @livewire('question',['model' => $post])
                </div>
                


            </div><!-- vista computador -->
            <div class="col-span-1 ml-10 hidden sm:block">
                 <!-- Artículos relacionados -->
                 @if(count($relatedPosts) > 0)
                    <h2 class="text-2xl text-center font-semibold mt-4 mb-4">
                        Artículos Relacionados
                    </h2>
                    <hr class="mt-1 mb-2">

                    @foreach ($relatedPosts as $relatedPost)
                    <a href="{{route('posts.show',$relatedPost)}}" class="block mb-6">
                        <article class="grid grid-cols-2 gap-1">
                            <figure class="overflow-hidden rounded-lg">
                                <img src="{{$relatedPost->image}}" alt="{{$relatedPost->title}}" class="w-full h-24 object-cover object-center mb-2 rounded-lg transition duration-300 ease-in-out hover:scale-110 hover:overflow-hidden">
                            </figure>
                            <div>
                                <h1 class="font-semibold text-sm mb-2">
                                    {{$relatedPost->title}}
                                </h1>
                            </div>
                        </article>
                    </a>
                    @endforeach
                @endif
            </div>
        </div><!-- vista mobile  -->
        <div class="col-span-1 sm:grid-cols-2 block sm:hidden">
             <!-- Artículos relacionados -->
             @if(count($relatedPosts) > 0)
                <h2 class="text-2xl text-center font-semibold mt-4 mb-4">
                    Artículos Relacionados
                </h2>
                <hr class="mt-1 mb-2">

                @foreach ($relatedPosts as $relatedPost)
                <a href="{{route('posts.show',$relatedPost)}}" class="block mb-6">
                    <article class="grid grid-cols-2 gap-1">
                        <figure class="overflow-hidden rounded-lg">
                            <img src="{{$relatedPost->image}}" alt="{{$relatedPost->title}}" class="w-full h-24 object-cover object-center mb-2 rounded-lg shadow-xl transition duration-300 ease-in-out hover:scale-110">
                        </figure>
                        <div>
                            <h1 class="font-semibold text-sm mb-2">
                                {{$relatedPost->title}}
                            </h1>
                        </div>
                    </article>
                </a>
                @endforeach
            @endif
        </div>
        </div>    




    </section>    
</x-app-layout>