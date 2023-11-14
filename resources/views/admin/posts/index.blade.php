<x-admin-layout :breadcrumb="[       // aqui le decimos con :antes que lo que le pasaremos será un array codigo php
    [
        'name' => 'Home',
        'url' => route('admin.dashboard')
    ],
    [
        'name' => 'Artículos',
    ],
]">
  

    <div class="flex justify-end mb-4">
        <a class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 " href="{{route('admin.posts.create')}}">Nuevo</a>
    </div>

    <ul class="space-y-8"> {{--Todos los elementos de la lista les da una separación de 2 rem la clase space-y-8--}}
        @foreach ($posts as $post)
        
            <li class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div>
                    <a href="{{route('admin.posts.edit', $post)}}">{{--ruta de editar imagen al hacer click en la imagen--}}
                        <img class="aspect-[16/9] object-cover object-center w-full" src="{{$post->image}}" alt="">
                    </a>
                </div>

                <div>
                    <h1 class="text-xl font-semibold">  {{--titulo de los post--}}
                        <a href="{{route('admin.posts.edit', $post)}}">
                            {{$post->title}}
                        </a>
                    </h1>

                    <hr class="mt-1 mb-2">

                    <span @class([
                            'bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded ' => $post->published,
                            'bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded' => ! $post->published,
                        ])>
                        {{ $post->published ? 'Publicado' : 'Borrador' }}
                    </span>

                    <p class="text-gray-700 mt-2">
                        {{ Str::limit($post->excerpt, 100) }} {{--con el facade str limit cortamos cuantos caracteres queremos mostrar y al final con ... --}}
                    </p>

                    <div class="flex justify-end mt-4">
                        <a href="{{route('admin.posts.edit', $post)}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none ">
                            Editar
                        </a>
                    </div>
                </div>
            </li>

        @endforeach
    </ul>

    <div class="mt-4">
        {{$posts->links()}}
    </div>
</x-admin-layout>