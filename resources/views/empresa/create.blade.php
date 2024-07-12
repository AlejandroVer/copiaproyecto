<x-app-layout>
    @include('layouts.content')
    <section class=" bg-white dark:bg-gray-900 mx-5 overflow-auto form-empresas border rounded-t-lg rounded-b-lg">
        <div class="bg-blue-700 h-14 flex items-center border rounded-t-lg">
            <h2 class="ml-5 mb-4 pt-4 text-xl  text-white dark:text-white"><i class="fa-solid fa-city mr-2 text-2xl"></i>Creación de empresas</h2>
        </div>

        <form class="max-w-lg mx-auto my-5" action="{{ route('empresa.create') }}" method="GET">
            <div class="flex justify-center">
                <div class="relative w-80 md:w-full lg:w-full border rounded-e-lg">
                    <input type="search" id="search-dropdown" name="query" value="{{$query}}" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Ingrese NIT o Razón Social a buscar" required />
                    <button type="submit" class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-blue-700 rounded-e-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                        <span class="sr-only">Search</span>
                    </button>
                </div>
            </div>
        </form>
    
        @if (session('info'))
        <div id="alertMessage" class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
            <span class="font-medium">{{(session('info'))}}</span>
        </div>
        @endif
        
        
    <style>
        /* Agregamos una transición para el mensaje de alerta */
        .alert-message {
            transition: opacity 0.5s ease-out;
        }
    </style>
    
    @if ($query != '')
    <div class="max-w-lg ml-5 my-5">
        <a href="{{ route('empresas.export.create', ['search' => request('search')]) }}" class="bg-green-700 hover:bg-green-800 text-white text-sm py-2 px-4 rounded">Exportar a Excel</a>
    </div>
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Sucursal
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Razon
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Sede
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Dirección
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Barrio
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Ubicación
                    </th>
                </tr>
            </thead>
            <tbody>
    
                @if(count($empresas)<=0)
    
                <tr>
                    <td colspan="5" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">No hay resultados</td>
                </tr>
    
                @else
    
                @foreach ($empresas as $empresa)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$empresa->id}}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$empresa->ciudad}}
                    </th>
                    <td class="px-6 py-4">
                        {{$empresa->name}}
                    </td>
                    <td class="px-6 py-4">
                        {{$empresa->nombre_sede}}
                    </td>
                    <td class="px-6 py-4">
                        {{$empresa->direccion}}
                    </td>
                    <td class="px-6 py-4">
                        {{$empresa->barrio}}
                    </td>
                    <td class="px-6 py-4">
                        <a class="text-green-700" href="https://www.google.com/maps/search/?api=1&query={{$empresa->geoubicacion}}" target="_blank">Ver mapa</a>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
        {{$empresas->links()}}
    </div>
    
        <div class="py-8 px-4 mx-auto max-w-2xl lg:pb-16">
            
                {!! Form::open(['route' => 'empresa.store']) !!}
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        {!! Form::label('name', 'Razón Social',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
                        @if ($empresas->count() > 0)
                        {!! Form::text('name', $empresas[0]->name, ['class' => 'bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Nombre de la empresa', 'readonly' => true]) !!}
                        @else
                        {!! Form::text('name', $queryName, ['id' => 'name', 'class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Nombre de la empresa']) !!}
                        @endif
                        @error('name')
                        <span class="text-red-500 text-sm">{{$message}}</span>     
                        @enderror
                    </div>

                    <div class="w-full">
                        {!! Form::label('nit', 'NIT',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
                        @if ($empresas->count() > 0)
                        {!! Form::number('nit', $empresas[0]->nit, ['class' => 'bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Ingrese el nit...', 'readonly' => true]) !!}
                        @else
                        {!! Form::number('nit', $queryNit, ['id' => 'nit', 'class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Ingrese el nit...']) !!}
                        @endif
                        @error('nit')
                        <span class="text-red-500 text-sm">{{$message}}</span>     
                        @enderror
                    </div>
                    <div>
                        {!! Form::label('nombre_sede', 'Nombre de la sede principal',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
                        {!! Form::text('nombre_sede', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Sede principal...']) !!}
                        @error('nombre_sede')
                        <span class="text-red-500 text-sm">{{$message}}</span>     
                        @enderror
                    </div>
                    <div class="w-full">
                        {!! Form::label('direccion', 'Dirección',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
                        {!! Form::text('direccion', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Dirección...']) !!}
                        @error('direccion')
                        <span class="text-red-500 text-sm">{{$message}}</span>     
                        @enderror
                    </div>
                    <div>
                        {!! Form::label('barrio','Barrio',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
                        {!! Form::text('barrio', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Barrio...']) !!}
                        @error('barrio')
                        <span class="text-red-500 text-sm">{{$message}}</span>     
                        @enderror
                    </div>
                    <div>
                        {!! Form::label('ciudad', 'Ciudad',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
                        {!! Form::text('ciudad', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Ciudad...']) !!}
                        @error('ciudad')
                        <span class="text-red-500 text-sm">{{$message}}</span>     
                        @enderror
                    </div>
                    <div>
                        {!! Form::label('geoubicacion', 'Geoubicacion',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
                        {!! Form::text('geoubicacion', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Geoubicación de la sede...']) !!}
                        @error('geoubicacion')
                        <span class="text-red-500 text-sm">{{$message}}</span>     
                        @enderror
                    </div>  
                    <div class="w-full">
                        {!! Form::label('telefono', 'Telefono',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
                        {!! Form::number('telefono', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Telefono...']) !!}
                        @error('telefono')
                        <span class="text-red-500 text-sm">{{$message}}</span>     
                        @enderror
                    </div>
                    <div>
                        {!! Form::label('rep_legal', 'RepLegal',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
                        {!! Form::text('rep_legal', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Rep. Legal...']) !!}
                        @error('rep_legal')
                        <span class="text-red-500 text-sm">{{$message}}</span>     
                        @enderror
                    </div>
                    <div>
                        {!! Form::label('cel_rep_legal', 'CelRepLegal',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
                        {!! Form::number('cel_rep_legal', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Celular Rep. Legal...']) !!}
                        @error('cel_rep_legal')
                        <span class="text-red-500 text-sm">{{$message}}</span>     
                        @enderror
                    </div>
                    <div>
                        {!! Form::label('cargo_rep_legal', 'CargoRepLegal',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
                        {!! Form::text('cargo_rep_legal', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Cargo Rep. Legal...']) !!}
                        @error('cargo_rep_legal')
                        <span class="text-red-500 text-sm">{{$message}}</span>     
                        @enderror
                    </div>
                    <div>
                        {!! Form::label('email_rep_legal', 'EmailRepLegal',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
                        {!! Form::email('email_rep_legal', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Email Rep. Legal...']) !!}
                        @error('email_rep_legal')
                        <span class="text-red-500 text-sm">{{$message}}</span>     
                        @enderror
                    </div>
                    <div>
                        {!! Form::label('jefe_th', 'Jefe_TH',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
                        {!! Form::text('jefe_th', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Jefe Talento Humano...']) !!}
                        @error('jefe_th')
                        <span class="text-red-500 text-sm">{{$message}}</span>     
                        @enderror
                    </div>
                    <div>
                        {!! Form::label('cargo_jefe_th', 'Cargo_Jefe_TH',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
                        {!! Form::text('cargo_jefe_th', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Cargo Jefe Talento Humano']) !!}
                        @error('cargo_jefe_th')
                        <span class="text-red-500 text-sm">{{$message}}</span>     
                        @enderror
                    </div>
                    <div>
                        {!! Form::label('cel_jefe_th', 'Cel_Jefe_TH',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
                        {!! Form::number('cel_jefe_th', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Cel Jefe Talento Humano']) !!}
                        @error('cel_jefe_th')
                        <span class="text-red-500 text-sm">{{$message}}</span>     
                        @enderror
                    </div>
                    <div>
                        {!! Form::label('email_jefe_th', 'Email_Jefe_TH',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
                        {!! Form::email('email_jefe_th', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Mail Jefe Talento Humano']) !!}
                        @error('email_jefe_th')
                        <span class="text-red-500 text-sm">{{$message}}</span>     
                        @enderror
                    </div>
                    <div>
                        {!! Form::label('contacto_th', 'Contacto_TH',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
                        {!! Form::text('contacto_th', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Contacto Talento Humano']) !!}
                        @error('contacto_th')
                        <span class="text-red-500 text-sm">{{$message}}</span>     
                        @enderror
                    </div>
                    <div>
                        {!! Form::label('cargo_contacto_th', 'Cargo_Contacto_TH',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
                        {!! Form::text('cargo_contacto_th', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Cargo Contacto Talento Humano']) !!}
                        @error('cargo_contacto_th')
                        <span class="text-red-500 text-sm">{{$message}}</span>     
                        @enderror
                    </div>
                    <div>
                        {!! Form::label('cel_contacto_th', 'Cel_Contacto_TH',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
                        {!! Form::number('cel_contacto_th', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Cel Contacto Talento Humano']) !!}
                        @error('cel_contacto_th')
                        <span class="text-red-500 text-sm">{{$message}}</span>     
                        @enderror
                    </div>
                    <div>
                        {!! Form::label('email_contacto_th', 'Email_Contacto_TH',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
                        {!! Form::email('email_contacto_th', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Email Contacto Talento Humano']) !!}
                        @error('email_contacto_th')
                        <span class="text-red-500 text-sm">{{$message}}</span>     
                        @enderror
                    </div>
                    <div>
                        {!! Form::label('numero_trabajadores', 'Numero trabajadores',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
                        {!! Form::text('numero_trabajadores', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Numero trabajadores...']) !!}
                        @error('numero_trabajadores')
                        <span class="text-red-500 text-sm">{{$message}}</span>     
                        @enderror
                    </div>
                    
                    <div>
                        {!! Form::label('estado', 'Estado Sede',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
                        {!! Form::select('estado', ['Activa' => 'Activa', 'Inactiva' => 'Inactiva'], 'Activa', ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500']) !!}
                        @error('estado')
                        <span class="text-red-500 text-sm">{{$message}}</span>     
                        @enderror
                    </div>  
                    {!! Form::submit('Crear Empresa', ['class' => 'inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800']) !!}
                </div>
                
                {!! Form::close() !!}
        </div>
        @endif
    </section>

    <script>
        setTimeout(function() {
            var alertMessage = document.getElementById('alertMessage');
            if (alertMessage) {
                alertMessage.style.opacity = 0;
                setTimeout(function() {
                    alertMessage.remove();
                }, 500); 
            }
        }, 3000); 

    </script>
</x-app-layout>