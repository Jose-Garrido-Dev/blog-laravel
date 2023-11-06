<x-admin-layout>

    <div class="bg-white shadow rounded-lg p-6">

        <form action="{{route('admin.permissions.update', $permission)}}" method="post">
            @csrf
            @method('PUT')

            <x-validation-errors class="mb-4" />


            <div class="mb-4">
                <x-label class="mb-1">
                    Nombre del Permiso
                </x-label>
                <x-input class="w-full" name="name" placeholder="Ingrese el nombre del permiso: " value="{{old('name',$permission->name)}}" />
            </div>

            <x-danger-button class="mr-2" onclick="deletePermission()">
                Eliminar
            </x-danger-button>


            <x-button>
                Actualizar Permiso
            </x-button>
        </form>

        <form action="{{route('admin.permissions.destroy', $permission)}}" method="post" id="formDelete" >
            @csrf
            @method('DELETE')
        
        </form>
    </div>


    @push('js')
      <script >
            function deletePermission(){
                let form = document.getElementById('formDelete');
                form.submit();
            }
      </script>  
    @endpush

</x-admin-layout>