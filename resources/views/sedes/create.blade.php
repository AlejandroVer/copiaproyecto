<x-app-layout>
    @include('layouts.content')
    <section class=" bg-white dark:bg-gray-900 mx-5 overflow-auto form-empresas border rounded-t-lg rounded-b-lg">
        <div class="bg-blue-700 h-14 flex items-center border rounded-t-lg">
            <h2 class="ml-5 mb-4 pt-4 text-xl  text-white dark:text-white"><i class="fa-solid fa-landmark mr-2 text-2xl"></i>Creación de sedes</h2>
        </div>
        @if (session('success'))
        <div id="alertMessage" class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
            <span class="font-medium">{{(session('success'))}}</span>
        </div>
        @endif
        <div class="py-8 px-4 mx-auto max-w-2xl lg:pb-16">
        {!! Form::open(['route' => 'sedes.store']) !!}
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        {!! Form::label('empresa', 'Seleccione la Empresa',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
                        {!! Form::select('empresa_id',$empresas->pluck('name', 'id'), null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Seleccione la Empresa']) !!}
                        @error('empresa')
                        <span class="text-red-500 text-sm">{{$message}}</span>     
                        @enderror
                    </div>
                    <div class="sm:col-span-1">
                        {!! Form::label('nombre_sede', 'Nombre de la Sede',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
                        {!! Form::text('nombre_sede', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Digite el nombre de la sede']) !!}
                        @error('nombre_sede')
                        <span class="text-red-500 text-sm">{{$message}}</span>     
                        @enderror
                    </div>
                    <div class="w-full">
                        {!! Form::label('direccion', 'Dirección',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
                        {!! Form::text('direccion', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Digite la dirección']) !!}
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
                        {!! Form::label('estado', 'Estado Sede',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
                        {!! Form::select('estado', ['Activa' => 'Activa', 'Inactiva' => 'Inactiva'], 'Activa', ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500']) !!}
                        @error('estado')
                        <span class="text-red-500 text-sm">{{$message}}</span>     
                        @enderror
                    </div> 
                    {!! Form::submit('Crear Sede', ['class' => 'inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800']) !!}
                </div>
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