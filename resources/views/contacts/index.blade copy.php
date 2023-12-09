<x-app-layout>

    <figure class="mt-1">
        <img src="{{ asset('/img/home/banner.jpg') }}" class="w-full aspect-[3/1] object-cover object-center" alt="">
    </figure>
    

    <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <form action="{{route('contacts.store')}}" method="POST">
                @csrf
                <x-validation-errors class="mb-4"/>
                <div class="mb-4">
                    <x-label>
                        Nombre
                    </x-label>
                    <x-input type="text" name="name" class="w-full" value="{{old('name')}}" placeholder="Ingrese el nombre de contacto"  />
                </div>
                <div class="mb-4">
                    <x-label>
                        Correo
                    </x-label>
                    <x-input type="email" name="email" class="w-full" value="{{old('email')}}" placeholder="Ingrese el Correo eléctronico"  />
                </div>

                <div class="mb-4">
                    <x-label>
                        Mensaje
                    </x-label>
                    <textarea name="message" id="" cols="30" rows="4" value="{{old('message')}}" class="w-full border-gray-300  focus:border-indigo-500  focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Ingrese el mensaje"></textarea>
                </div>

                <div class="flex justify-end">
                    <x-button>
                        Enviar
                    </x-button>
                </div>
            </form>
        </div>
    </section>    
</x-app-layout>    