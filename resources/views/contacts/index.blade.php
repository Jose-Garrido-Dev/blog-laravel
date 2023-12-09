<x-app-layout>

    <figure class="mt-1">
        <img src="{{ asset('/img/home/banner.jpg') }}" class="w-full aspect-[3/1] object-cover object-center" alt="">
    </figure>
    

    <div class="grid max-w-screen-xl grid-cols-1 gap-8 px-8 py-16 mx-auto rounded-lg md:grid-cols-2 md:px-12 lg:px-16 xl:px-32 text-gray-800 bg-gray-100">
        <div class="flex flex-col justify-between">
            <div class="space-y-2">
                <h2 class="text-4xl font-bold leadi lg:text-5xl">Enviame un mensaje!</h2>
                <div class="text-gray-400"><p class="text-center">Si deseas poder compartir artículos en el blog relacionados a la ciberseguridad o programación.</p> </div>
            </div>
            <img src="{{asset('/img/home/contacto.png')}}" alt="" class="p-6 md:h-64">
        </div>
        <form action="{{route('contacts.store')}}" method="POST" class="space-y-6">
            @csrf
            <x-validation-errors class="mb-4"/>
            <div>
                <label for="name" class="text-sm">Nombre</label>
                <input type="text" name="name" value="{{old('name')}}" placeholder="Ingrese el nombre de contacto" class="w-full p-3 rounded bg-gray-100">
            </div>
            <div>
                <label for="email" class="text-sm">Email</label>
                <input type="email" name="email" value="{{old('email')}}" placeholder="Ingrese el Correo eléctronico" class="w-full p-3 rounded bg-gray-100">
            </div>
            <div>
                <label for="message" class="text-sm">Mensaje</label>
                <textarea name="message" id="" cols="30" rows="4" value="{{old('message')}}" class="w-full  bg-gray-100  focus:border-indigo-500  focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Ingrese el mensaje"></textarea>
            </div>
            <button type="submit" class="w-full p-3 text-sm font-bold tracki uppercase rounded bg-blue-400 hover:bg-blue-600 text-gray-900">Enviar Mensaje</button>
        </form>
    </div>
</x-app-layout>    