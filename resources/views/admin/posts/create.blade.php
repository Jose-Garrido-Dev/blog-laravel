<x-admin-layout :breadcrumb="[       // aqui le decimos con :antes que lo que le pasaremos será un array codigo php
    [
        'name' => 'Home',
        'url' => route('admin.dashboard')
    ],
    [
        'name' => 'Artículos',
        'url' => route('admin.posts.index')
    ],
    [
        'name' => 'Nuevo',
    ],
]">

    <h1 class="text-3xl font-semibold mb-2">
        Nuevo artículo
    </h1>

    <form action="{{route('admin.posts.store')}}" 
        method="POST"  {{--con alpine.js  le indicamos que reciba y escriba  el titulo y lo convierta en slug--}}
        x-data="data()"{{--llamamos a la funcion data que está mas abajo con codigo JS, con x init le decimos a alpine que se mantenga a la escucha a cualquier cambio de titulo que lo dejetecte y llame metodo xwatch--}}
        x-init="$watch('title', value => { string_to_slug(value) })">

        @csrf

        <x-validation-errors class="mb-4" />

        <div class="mb-4">
            <x-label class="mb-2">
                Título del artículo
            </x-label>
{{--ocupamos componentes jetstream--}}
            <x-input name="title"
                value="{{old('title')}}"
                x-model="title" {{--con esta variable cualquier cambio que hagamos en eltitulo se verá reflejado en el slug--}}
                class="w-full" 
                placeholder="Ingrese el nombre del artículo" />
        </div>

        <div class="mb-4">
            <x-label class="mb-2">
                Slug
            </x-label>

            <x-input name="slug"
                value="{{old('slug')}}"
                x-model="slug"
                class="w-full" 
                placeholder="Ingrese el slug del articulo" />
        </div>

        <div class="mb-4">
            <x-label>
                Categoria
            </x-label>

            <x-select class="w-full" name="category_id">

                @foreach ($categories as $category)
                    <option @selected(old('category_id') == $category->id){{--la directiva selected nos permitirá agregar condicional con old preguntamos si huboerror de validacion y para que mantengamos la categoria seleccionada--}}
                        value="{{$category->id}}">
                        {{$category->name}}
                    </option>
                @endforeach

            </x-select>
        </div>


        <div class="flex justify-end">
            <x-button>
                Crear artículo
            </x-button>
        </div>

    </form>

{{--con alpine.js  le indicamos que reciba y escriba  el titulo y lo convierta en slug , con expresiones regulares capture str lo transofmre en slug valido que excluya todos esos valores y apenas lo tenga lo remplce--}}
    @push('js')
        
        <script>
            function data(){
                return {
                    title: '',
                    slug: '',
                    string_to_slug(str){
                        str = str.replace(/^\s+|\s+$/g, '');
                        str = str.toLowerCase();
                        var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
                        var to = "aaaaeeeeiiiioooouuuunc------";
                        for (var i = 0, l = from.length; i < l; i++) {
                            str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
                        }
                        str = str.replace(/[^a-z0-9 -]/g, '')
                            .replace(/\s+/g, '-')
                            .replace(/-+/g, '-');
                        this.slug = str;
                    }
                }
            }
        </script>

    @endpush

</x-admin-layout>