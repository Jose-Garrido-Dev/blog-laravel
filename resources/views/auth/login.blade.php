<x-guest-layout>
<!-- component -->
    <section class="min-h-screen flex items-stretch text-black ">

        <div class="lg:flex w-1/2 hidden bg-gray-500 bg-no-repeat bg-cover relative items-center shadow-xl" style="background-image: url(http://blog.test/img/home/login.jpeg);">
            <div class="absolute bg-black opacity-60 inset-0 z-0"></div>
            <div class="w-full px-24 z-10">
                <h1 class="text-5xl font-bold text-left text-blue-600 tracking-wide">Ningún sistema es Seguro.</h1>

            </div>
        </div>
        <div class="lg:w-1/2 w-full flex items-center justify-center text-center md:px-16 px-0 z-0" style="background-color: #e5e7eb;">
            <div class="absolute lg:hidden z-10 inset-0 bg-gray-500 bg-no-repeat bg-cover items-center shadow-xl h-screen" style="background-image: url(http://blog.test/img/home/login.jpeg);">

                <div class="absolute bg-gray-200 opacity-60 inset-0 z-0"></div>
            </div>
            <div class="w-full py-6 z-20">
                <h1 class="my-6 flex justify-center">
                    <img src="{{env('APP_URL')}}./img/home/logo_cn.png" class="w-28" alt="">
                </h1>

                <x-validation-errors class="mb-4" />

                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                        {{ session('status') }}
                    </div>
                @endif

                <p class="text-gray-800 font-semibold">
                    Ingrese su dirección de correo y su contraseña
                </p>
                <form method="POST" action="{{ route('login') }}" class="sm:w-2/3 w-full px-4 lg:px-0 mx-auto">
                    @csrf
                    <div class="pb-2 pt-4">
                        <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" class="block w-full p-4 text-lg  bg-white rounded-lg">
                    </div>
                    <div class="pb-2 pt-4">
                        <input class="block w-full p-4 text-lg rounded-lg bg-white"id="password" type="password" name="password" required autocomplete="current-password">
                    </div>
                    <div class="block mt-4">
                        <label for="remember_me" class="flex items-center">
                            <x-checkbox id="remember_me" name="remember" />
                            <span class="ml-2 text-sm text-gray-800 font-semibold">{{ __('Recuerdame') }}</span>
                        </label>
                    </div>
                    <div class="flex">
                        @if (Route::has('password.request'))
                        <a class="underline text-sm text-blue-800 font-semibold rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 flex-1" href="{{ route('password.request') }}">
                            {{ __('Olvidaste tu contraseña?') }}
                        </a>
                        @endif
    

                        <a href="{{route('register')}}" class="underline text-sm text-blue-800 font-semibold rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 flex-1" href="{{ route('password.request') }}">
                            {{ __('¿No tienes cuenta? Registrate') }}
                        </a>

                    </div>
                    



                    
                    <div class="px-4 pb-2 pt-4">
                        <button class="uppercase block w-full p-4 text-lg rounded-full bg-blue-500 hover:bg-blue-600 focus:outline-none">Iniciar Sesión</button>
                    </div>

                </form>
            </div>
        </div>
    </section>

</x-guest-layout>
