<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,400;0,500;0,700;1,100;1,400;1,500&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/css/style.css', 'resources/js/app.js'])
        
        <script src="https://kit.fontawesome.com/3198e7ccce.js" crossorigin="anonymous"></script>

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="bg-blue-800">
        <x-banner />

           {{-- Mobile logos menu --}}
    <div class=" mobile-menu md:hidden text-white" x-data="{open: false}">
        <div class="flex mb-6 justify-between items-center px-10 pt-4 w-full">
                <img alt="nmvPostal" class="w-1/2 bg-white rounded-lg ml-1 pb-5" style="padding: 10px" src="/images/{{ Auth::user()->nmvCliente->imagen}}">
            <button class="cursor-pointer w-12 h-12 mt-3 rounded-md hover:bg-gray-700 hover:text-white " x-on:click="open = true" >
                <i class="fas fa-bars text-3xl"></i>
            </button>
        </div>
        {{-- Mobile Menu Button --}}
    <div class="lg:hidden" x-show="open" x-on:click.away="open = false">
        <div class="px-2 pt-2 pb-3 space-y-1 flex flex-col">
            <a class="hover:text-gray-300" href="{{route('agendas.create')}}"><i class="fa-regular fa-calendar pr-3 text-2xl icon-side mt-2 hover:text-gray-500"></i>Agendar Visita</a>
            <a class="hover:text-gray-300" href="{{route('empresa.create')}}"><i class="fa-regular fa-building pr-3 text-2xl icon-side mt-2 hover:text-gray-500"></i>Crear Empresa</a>
            <a class="hover:text-gray-300" href="{{route('sedes.create')}}"><i class="fa-solid fa-landmark pr-3 text-2xl icon-side mt-2 hover:text-gray-500"></i>Crear Sede</a>
            <a class="hover:text-gray-300" href="{{route('empresa.index')}}"><i class="fa-solid fa-pen-to-square pr-3 text-2xl icon-side mt-2 hover:text-gray-500"></i>Actualizar Empresa</a>
            <a class="hover:text-gray-300" href="{{route('users.create')}}"><i class="fa-solid fa-user pr-3 text-2xl icon-side mt-2 hover:text-gray-500"></i>Creación Usuarios</a>
            <a class="hover:text-gray-300" href="{{route('users.index')}}"><i class="fa-solid fa-circle-user pr-3 text-2xl icon-side mt-2 hover:text-gray-500"></i>Usuarios</a>
            <a class="hover:text-gray-300" href="{{route('reportes.index')}}"><i class="fa-solid fa-calendar-days pr-3 text-2xl icon-side mt-2 hover:text-gray-500"></i>Reportes</a>
        </div>
    </div>
    </div>
    <div class="border-t border-gray-400 opacity-25"></div>

    

    <div class=" md:h-screen md:w-40 lg:w-64 fixed items-center text-slate-200 hidden md:flex md:flex-col md:justify-center">
        <!-- Encabezado del Sidebar -->
        <div class="flex justify-center">
            <div class="p-4 mt-5 md:w-20 lg:w-40 flex items-center bg-white rounded-lg ">
                <img src="/images/{{ Auth::user()->nmvCliente->imagen}}" alt="" class="img-side">
            </div>
        </div>
        
        <!-- Elementos del Sidebar -->
        <div class="flex-1 overflow-y-auto hidden md:block lg:block" id="sidebarItems">
            <!-- Sección 1 -->
            <div class="border-t mt-5 border-gray-400 opacity-25"></div>   
            <div class="  py-2 px-4">
                <ul class="mt-2">
                    <li class="mb-6 hidden lg:block"><a href="{{route('agendas.create')}}" class="hover:text-gray-300"><i class="fa-regular fa-calendar pr-3  text-2xl icon-side"></i>Agendar Visita</a></li>
                    <li class="mb-6 hidden lg:block"><a href="{{route('empresa.create')}}" class="hover:text-gray-300"><i class="fa-regular fa-building pr-3  text-2xl icon-side"></i>Crear Empresa</a></li>
                    <li class="mb-6 hidden lg:block"><a  href="{{route('sedes.create')}}" class="hover:text-gray-300"><i class="fa-solid fa-landmark pr-3 text-2xl icon-side hover:text-gray-500"></i>Crear Sede</a></li>
                    <li class="mb-6 hidden lg:block"><a href="{{route('empresa.index')}}" class="hover:text-gray-300"><i class="fa-solid fa-pen-to-square pr-3  text-2xl icon-side"></i>Actualizar Empresa</a></li>
                    <li class="mb-6 lg:hidden"><a href="{{route('agendas.create')}}" class="hover:text-gray-300"><i class="fa-regular fa-calendar  text-2xl icon-side"></i></a></li>
                    <li class="mb-6 lg:hidden"><a href="{{route('empresa.create')}}" class="hover:text-gray-300"><i class="fa-regular fa-building  text-2xl icon-side"></i></a></li>
                    <li class="mb-6 lg:hidden"><a href="{{route('sedes.create')}}" class="hover:text-gray-300"><i class="fa-solid fa-landmark  text-2xl icon-side"></i></a></li>
                    <li class="mb-6 lg:hidden"><a href="{{route('empresa.index')}}" class="hover:text-gray-300"><i class="fa-solid fa-pen-to-square text-2xl icon-side"></i></a></li>
                    
                </ul>
            </div>
            <!-- Línea divisoria -->
            <div class="border-t border-gray-400 opacity-25"></div>
            <!-- Sección 2 -->
            <div class="py-2 px-4">
                <ul class="mt-2 items-center">
                    <li class="mb-6 hidden lg:block"><a href="{{route('users.create')}}" class="hover:text-gray-300"><i class="fa-solid fa-user pr-3 text-2xl icon-side"></i>Creación Usuarios</a></li>
                    <li class="mb-6  hidden  lg:block"><a href="{{route('users.index')}}" class="hover:text-gray-300"><i class="fa-solid fa-circle-user pr-3 text-2xl icon-side"></i>Usuarios</a></li>
                    <li class="mb-6 hidden lg:block"><a href="{{route('reportes.index')}}" class="hover:text-gray-300"><i class="fa-solid fa-calendar-days pr-3 text-2xl icon-side"></i>Reportes</a></li>
                    <li class="mb-6 lg:hidden"><a href="{{route('users.create')}}" class="hover:text-gray-300"><i class="fa-solid  fa-user text-2xl icon-side"></i></a></li>
                    <li class="mb-6 lg:hidden"><a href="{{route('users.index')}}" class="hover:text-gray-300"><i class="fa-solid fa-circle-user text-2xl icon-side"></i></a></li>
                    <li class="mb-6 lg:hidden"><a href="{{route('reportes.index')}}" class="hover:text-gray-300"><i class="fa-solid fa-calendar-days text-2xl icon-side"></i></a></li>
                </ul>
            </div>
            <!-- Línea divisoria -->
            <div class="border-t border-gray-400 opacity-25"></div>
            <!-- Sección 3 -->
            
        </div>
    </div>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </body>
</html>
