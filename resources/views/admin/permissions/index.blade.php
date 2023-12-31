<x-admin-layout :breadcrumb="[       // aqui le decimos con :antes que lo que le pasaremos será un array codigo php
    [
        'name' => 'Home',
        'url' => route('admin.dashboard')
    ],
    [
        'name' => 'Permisos',
    ],
]">

    <div class="flex justify-end mb-4">
        <a class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2" href="{{route('admin.permissions.create')}}">Nuevo</a>
    </div>
    @if ($permissions->count())
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                <tr>
                    <th scope="col" class="px-6 py-3">
                       ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        NOMBRE
                    </th>

                    <th scope="col" class="px-6 py-3">
                        ACCIÓN
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $permission)
                
                    <tr class="bg-white border-b ">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                            {{ $permission->id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $permission->name }}
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{route('admin.permissions.edit', $permission)}}">Editar</a>
                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>
    </div>     
    @else
    <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50" role="alert">
        <span class="font-medium">Información !</span> Todavía no tiene permisos registrados
      </div>
    @endif

</x-admin-layout>