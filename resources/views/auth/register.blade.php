<x-guest-layout>
<!-- component -->
<div class="font-sans">
    <div class="relative min-h-screen flex flex-col sm:justify-center items-center bg-gray-100 ">
        <div class="relative sm:max-w-sm w-full">
            <div class="card bg-red-800 shadow-lg  w-full h-full rounded-3xl absolute  transform -rotate-6"></div>
            <div class="card bg-blue-400 shadow-lg  w-full h-full rounded-3xl absolute  transform rotate-6"></div>
            <div class="relative w-full rounded-3xl  px-4 py-2 bg-gray-100 shadow-md">
                <div class="flex justify-center">
                    <img src="{{env('APP_URL')}}./img/home/logo_registro.png " class="w-28 h-28 justify-center" alt="">
                </div>

                <form method="POST" action="{{ route('register') }}" class="mt-0">
                    @csrf
                                    
                    <div>
                        <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Nombres" class="mt-0 block w-full border-none bg-gray-100 h-11 rounded-xl shadow-lg hover:bg-blue-100 focus:bg-blue-100 focus:ring-0">
                    </div>
        
                    <div class="mt-6">                
                        <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Correo electronico" class="mt-1 block w-full border-none bg-gray-100 h-11 rounded-xl shadow-lg hover:bg-blue-100 focus:bg-blue-100 focus:ring-0">                           
                    </div>

                    <div class="mt-6">                
                        <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="Contraseña" class="mt-1 block w-full border-none bg-gray-100 h-11 rounded-xl shadow-lg hover:bg-blue-100 focus:bg-blue-100 focus:ring-0">                           
                    </div>

                    <div class="mt-6">                
                        <input id="password_confirmation" name="password_confirmation" required autocomplete="new-password" type="password" placeholder="Confirmar contraseña" class="mt-1 block w-full border-none bg-gray-100 h-11 rounded-xl shadow-lg hover:bg-blue-100 focus:bg-blue-100 focus:ring-0">                           
                    </div>

                    
        
                    <div class="mt-6">
                        
                        <button class="bg-blue-500 w-full py-3 rounded-xl text-white shadow-xl hover:shadow-inner focus:outline-none transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">
                            Registrar
                        </button>
                    </div>
        
                    <div class="mt-6">
                        <div class="flex justify-center items-center">
                            <label class="mr-2" >¿Ya tienes una cuenta?</label>
                            <a href="{{route('login')}}" class=" text-blue-500 transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">
                                Iniciar sesion
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</x-guest-layout>
