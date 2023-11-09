<x-admin-layout :breadcrumb="[       // aqui le decimos con :antes que lo que le pasaremos será un array codigo php
    [
        'name' => 'Home',
        'url' => route('admin.dashboard')
    ],
    [
        'name' => 'Roles',
        'url' => route('admin.roles.index')
    ],
    [
        'name' => 'Editando Rol : '.$role->name,
    ],
]">

    <div class="bg-white shadow rounded-lg p-6">

        <form action="{{route('admin.roles.update', $role)}}" method="post">
            @csrf
            @method('PUT')

            <x-validation-errors class="mb-4" />


            <div class="mb-4">
                <x-label class="mb-1">
                    Nombre del rol
                </x-label>
                <x-input class="w-full" name="name" placeholder="Ingrese el nombre del rol: " value="{{old('name',$role->name)}}" />
            </div>

            <div class="mb-4">
                <x-label class="mb-1">
                    Indique los permisos que tendrá el rol indicado
                </x-label>

                <ul>
                    @foreach ($permissions as $permission)
                        <li>
                            <label>
                                <x-checkbox 
                                        name="permission[]"
                                        value="{{$permission->id}}"
                                        :checked="in_array($permission->id, old('permissions', $role->permissions->pluck('id')->toArray()))" />
                                        {{$permission->name}}

                            </label>
                        </li>
                    @endforeach
                </ul>
            </div>

            <x-danger-button class="mr-2" onclick="deleteRole()">
                Eliminar
            </x-danger-button>


            <x-button>
                Actualizar Rol
            </x-button>
        </form>

        <form action="{{route('admin.roles.destroy', $role)}}" method="post" id="formDelete" >
            @csrf
            @method('DELETE')
        
        </form>
    </div>


    @push('js')
      <script >
            function deleteRole(){
                let form = document.getElementById('formDelete');
                form.submit();
            }
      </script>  
    @endpush

</x-admin-layout>