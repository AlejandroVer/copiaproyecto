<x-app-layout>
    {{-- Contenido --}}
    <div class=" md:ml-40 flex flex-col h-screen mx-5 mt-5 mb-5 bg-slate-100 lg:ml-64 border-4 rounded-3xl mr-8">
        
        <header class="p-3 mx-5 flex justify-end lg:justify-end items-center" x-data="{open: false}">
            <button x-on:click="open = true" type="button" class="relative flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                <span class="absolute -inset-1.5"></span>
                <span class="sr-only">Open user menu</span>
                <img class="h-8 w-8 rounded-full" src="{{ auth()->user()->profile_photo_url}}" alt="">
              </button>
              <div x-show="open" x-on:click.away="open = false" class="absolute flex flex-col  h-24 right-0 z-10 mr-10 w-48 origin-top-right rounded-md bg-blue-900 py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none dropdown-menu" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                <!-- Active: "bg-gray-100", Not Active: "" -->

                <span class="text-white text-sm px-4 py-2">
                    <?php
                    $fullName = Auth::user()->name;
                    $nameParts = explode(' ', $fullName);
                    $firstName = $nameParts[0];
                    $lastName = isset($nameParts[1]) ? $nameParts[1] : '';
                    echo $firstName . ' ' . $lastName;
                ?>
                  </span>

                  <div class="border-t mt-2 border-gray-400 opacity-25"></div>
    
                <form method="POST" action="{{ route('logout') }}" x-data>
                  @csrf
                  <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-white" role="menuitem" tabindex="-1" id="user-menu-item-2" @click.prevent="$root.submit();"><i class="fa-solid fa-arrow-right-from-bracket mr-1"></i>
                      Cerrar Sesión
                  </a>
                </form>
              </div>

        </header>

        

        <div class="bg-blue-800 mx-5 p-4 border rounded-t-lg text-white">
            Sistema gestión de almacenes
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 mx-5 bg-white gap-3">
            <div class="bg-slate-50 h-40 w-auto">1</div>
            <div class="bg-slate-50 h-40 w-auto">2</div>
            <div class="bg-slate-50 h-40 w-auto">3</div>
            <div class="bg-slate-50 h-40 w-auto">4</div>
            <div class="bg-slate-50 h-40 w-auto">5</div>
            <div class="bg-slate-50 h-40 w-auto">6</div>
        </div>
    </div>
</x-app-layout>
