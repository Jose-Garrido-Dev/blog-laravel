<x-app-layout>

    <figure>
        <img src="{{ asset('/img/home/banner.jpg') }}" class="w-full aspect-[3/1] object-cover object-center" alt="">
    </figure>
    

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl text-center font-semibold">
            Lista de Artículos
        </h1>
        <div class="space-y-8">
            @foreach ($posts as $post)
            <article class="grid grid-cols-2 gap-6">
                <figure>
                    <img src="{{$post->image}}" alt="{{$post->title}}">
                </figure>
                <div>
                    <h1 class="text-xl font-semibold">{{$post->title}}</h1>
                    <hr class="mt-1 mb-2">
                    <div>
                        @foreach($post->tags as $tag)
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-100 dark:text-blue-300">{{ $tag->name}}</span>
                            <h2 class="text-white">revisar</h2>
                        @endforeach
                    </div>
                </div>

            </article>
        @endforeach
        </div>


    </section>
</x-app-layout>