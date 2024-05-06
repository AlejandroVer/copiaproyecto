<x-app-layout>
    @include('layouts.content')
    
    <section class="bg-white dark:bg-gray-900 mx-5 overflow-auto border rounded-b-lg">
        <div class="bg-blue-700 h-14 flex items-center border rounded-t-lg">
            <h2 class="ml-5 mb-4 pt-4 text-xl  text-white dark:text-white"><i class="fa-solid fa-pen mr-2"></i>Agendamiento de Visitas</h2>
        </div>
        @if (session('success'))
        <div id="alertMessage" class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
            <span class="font-medium">{{(session('success'))}}</span>
        </div>
        @endif
    <form class="max-w-lg mx-auto my-5" id="formulario_busqueda" action="{{ route('agendas.create') }}" method="GET">
        <div class="flex justify-center">
            <div class="relative w-80 md:w-full lg:w-full border">
                <input type="search" id="search-dropdown" name="query" value="{{$query}}" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Ingrese NIT o Nombre de Empresa" required />
                <button type="submit" class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-blue-700 rounded-e-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                    <span class="sr-only">Search</span>
                </button>
            </div>
        </div>
    </form>

    @if ($query != '')
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
                    {{$empresa->geoubicacion}}
                </td>
                
                <td class="px-6 py-4">
                    <button onclick="seleccionarEmpresa('{{ $empresa->name }}', '{{$empresa->nombre_sede}}', '{{ $empresa->direccion }}', '{{ $empresa->barrio }}', '{{ $empresa->ciudad }}', '{{ $empresa->telefono }}', '{{$empresa->id}}')">Seleccionar</button>
                </td>
                
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    {{$empresas->links()}}
</div>
@endif

<div class="py-8 px-4 mx-auto max-w-2xl lg:pb-16">
            
    {!! Form::open(['route' => 'agendas.store']) !!}
    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
        <div class="sm:col-span-2">
            {!! Form::label('name', 'Razón Social',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
            {!! Form::text('name', null, ['id' => 'name', 'readonly' => true, 'class' => 'bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Razón Social...']) !!}
            @error('name')
            <span class="text-red-500 text-sm">{{$message}}</span>     
            @enderror
        </div>

        <div class="sm:col-span-2">
            {!! Form::label('sede', 'Sede / Regional',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
            {!! Form::text('sede', null, ['id' => 'sede', 'readonly' => true, 'class' => 'bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Sede...']) !!}
            @error('sede')
            <span class="text-red-500 text-sm">{{$message}}</span>     
            @enderror
        </div>

        <div class="w-full">
            {!! Form::label('direccion', 'Dirección',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
            {!! Form::text('direccion', null, ['id' => 'direccion', 'readonly' => true, 'class' => 'bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Dirección...']) !!}
            @error('direccion')
            <span class="text-red-500 text-sm">{{$message}}</span>     
            @enderror
        </div>
        <div class="w-full">
            {!! Form::label('barrio', 'Barrio',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
            {!! Form::text('barrio', null, ['id' => 'barrio', 'readonly' => true, 'class' => 'bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Barrio...']) !!}
            @error('barrio')
            <span class="text-red-500 text-sm">{{$message}}</span>     
            @enderror
        </div>
        <div>
            {!! Form::label('ciudad','Ciudad',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
            {!! Form::text('ciudad', null, ['id' => 'ciudad', 'readonly' => true, 'class' => 'bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Ciudad...']) !!}
            @error('ciudad')
            <span class="text-red-500 text-sm">{{$message}}</span>     
            @enderror
        </div>
        <div>
            {!! Form::label('telefono', 'Telefono',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
            {!! Form::number('telefono', null, ['id' => 'telefono', 'readonly' => true, 'class' => 'bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Telefono...']) !!}
            @error('telefono')
            <span class="text-red-500 text-sm">{{$message}}</span>     
            @enderror
        </div> 
        <div>
            {!! Form::label('fecha', 'Fecha Visita',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
            {!! Form::date('fecha', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500',]) !!}
            @error('fecha')
            <span class="text-red-500 text-sm">{{$message}}</span>     
            @enderror
        </div>
        <div class="w-full">
            {!! Form::label('hora', 'Hora Visita',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
            {!! Form::time('hora', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500',]) !!}
            @error('hora')
            <span class="text-red-500 text-sm">{{$message}}</span>     
            @enderror
        </div>
        <div class="w-full">
            {!! Form::label('objetivo', 'Objetivo de la visita',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
            {!! Form::select('objetivo', ['' => 'Seleccione Actividad a realizar','Asignación/PQR' => 'Asignación/PQR', 'Capacitación' => 'Capacitación', 'Cierre de negocio' => 'Cierre de negocio', 'Compensatorio - vacaciones' => 'Compensatorio - vacaciones', 'Entrega colaterales' => 'Entrega colaterales', 'Entrega cotización' => 'Entrega cotización', 'Entrega factura' => 'Entrega factura', 'Gestión comercial sedes cofrem' => 'Gestión comercial sedes cofrem', 'Incapacidad' => 'Incapacidad', 'Mantenimiento/entrega publicidad' => 'Mantenimiento/entrega publicidad','Planta' => 'Planta','Presentación portafolio' => 'Presentación portafolio','Programación Actividades' => 'Programación Actividades','Reunión' => 'Reunión','Seguimiento cotización' => 'Seguimiento cotización','Stand de servicios' => 'Stand de servicios','Toma de cotización' => 'Toma de cotización','Trámite de documentos' => 'Trámite de documentos'], null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500',]) !!}
            @error('objetivo')
            <span class="text-red-500 text-sm">{{$message}}</span>     
            @enderror
        </div>
        {!! Form::hidden('empresa_id', "", array('id' => 'empresa_id')) !!}
        {!! Form::submit('Agendar Visita', ['class' => 'inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800']) !!}
                
        {!! Form::close() !!}
        <div>
      
    </section>
</section>

<script>
    function seleccionarEmpresa(name, nombre_sede, direccion, barrio, ciudad, telefono, id) {
        document.getElementById('name').value = name;
        document.getElementById('sede').value = nombre_sede;
        document.getElementById('direccion').value = direccion;
        document.getElementById('barrio').value = barrio;
        document.getElementById('ciudad').value = ciudad;
        document.getElementById('telefono').value = telefono;
        document.getElementById('empresa_id').value = id;

    }
    setTimeout(function() {
        var alertMessage = document.getElementById('alertMessage');
        if (alertMessage) {
            alertMessage.style.opacity = 0;
            setTimeout(function() {
                alertMessage.remove();
            }, 500); // Espera 0.5 segundos antes de eliminar el elemento
        }
    }, 3000); // 3000 milisegundos = 2 segundos
</script>
</x-app-layout>