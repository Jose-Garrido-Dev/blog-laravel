@props([
    'breadcrumb' => [],
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/e2d71e4ca2.js" crossorigin="anonymous"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Styles -->
    @livewireStyles

    @stack('css')
</head>

<body class="font-sans antialiased sm:overflow-auto"
    :class="{ 'overflow-hidden': open }"
     x-data="{open: false}">

    @include('layouts.includes.admin.nav')

    @include('layouts.includes.admin.aside')

    <div class="p-4 sm:ml-64">
        {{--breadcrumb o miguitas de pan--}}
        <div class="mt-14 -mb-10 dlex justify-between items-center">
            @include('layouts.includes.admin.breadcrumb')

     {{--       @isset($action)
                {{ $action }}
            @endisset--}}
        </div>


        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg  mt-14">
            

            {{ $slot }}

        </div>
    </div>

    <div x-show="open" {{--se encarga de mostrar  cuando haya una condicional--}}
        x-on:click="open = false"
        style="display: none" 
        class="bg-gray-900 bg-opacity-50 fixed inset-0 z-30 sm:hidden"></div>

    @stack('modals')

    @livewireScripts

    @if (session('swal'))
    
        <script>
            Swal.fire(@json(session('swal'))) /*sweetaerts2*/
        </script>

    @endif

    <script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>

    @stack('js')




    <footer class="bg-white rounded-lg shadow  m-4">
        <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
            <span class="block text-sm text-gray-500 sm:text-center ">© 2023 <a href="#" class="hover:underline">Antr4x™</a>. Todos los derechos reservados.</span>
        </div>
    </footer>
    
    

</body>

</html>
