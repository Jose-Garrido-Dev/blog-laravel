<x-admin-layout>
    <div class="bg-white shadow rounded-lg p-6">

        <form action="{{route('admin.roles.store')}}" method="post">
            @csrf

            <x-validation-errors class="mb-4" />


            <div class="mb-4">
                <x-label class="mb-1">
                    Nombre del rol
                </x-label>
                <x-input class="w-full" name="name" placeholder="Ingrese el nombre del rol: " value="{{old('name')}}" />
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
                                        :checked="in_array($permission->id, old('permissions',[]))" />
                                        {{$permission->name}}

                            </label>
                        </li>
                    @endforeach
                </ul>
            </div>

            <x-button>
                Crear Rol
            </x-button>
        </form>


    </div>
</x-admin-layout>