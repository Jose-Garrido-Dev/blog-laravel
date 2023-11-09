<x-admin-layout :breadcrumb="[       // aqui le decimos con :antes que lo que le pasaremos será un array codigo php
    [
        'name' => 'Home',
        'url' => route('admin.dashboard')
    ],
    [
        'name' => 'Permisos',
        'url' => route('admin.permissions.index')
    ],
    [
        'name' => 'Nuevo',
    ],
]">
    <div class="bg-white shadow rounded-lg p-6">

        <form action="{{route('admin.permissions.store')}}" method="post">
            @csrf

            <x-validation-errors class="mb-4" />


            <div class="mb-4">
                <x-label class="mb-1">
                    Nombre del permiso
                </x-label>
                <x-input class="w-full" name="name" placeholder="Ingrese el nombre del permiso: " value="{{old('name')}}" />
            </div>


            <x-button>
                Crear Permiso
            </x-button>
        </form>


    </div>
</x-admin-layout>