<x-app-layout>
    @include('layouts.content')
    
    <section class="bg-white dark:bg-gray-900 mx-5 overflow-auto border rounded-b-lg">
        <div class="bg-blue-700 h-14 flex items-center border rounded-t-lg">
            <h2 class="ml-5 mb-4 pt-4 text-xl  text-white dark:text-white"><i class="fa-solid fa-pen mr-2"></i>Reporte de Agendas y Visitas</h2>
        </div>
        @if (session('success'))
        <div id="alertMessage" class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
            <span class="font-medium">{{(session('success'))}}</span>
        </div>
        @endif

        <div class="mt-5">
            {!! Form::open(['route' => 'agendas.store']) !!}
            <div class=" ">
        <div class="flex justify-center">
            {!! Form::label('fecha', 'Fecha Inicio',['class' => 'block text-sm font-medium text-blue-700 dark:text-white']) !!}
            {!! Form::date('fecha', null, ['class' => 'bg-gray-50 ml-5 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500',]) !!}
            @error('fecha')
            <span class="text-red-500 text-sm">{{$message}}</span>     
            @enderror
        </div>

        {!! Form::close() !!}

        </div>
    </div>
        
</section>
</x-app-layout>