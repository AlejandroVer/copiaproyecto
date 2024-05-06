<x-app-layout>
    @include('layouts.content')
    <section class=" bg-white dark:bg-gray-900 mx-5 overflow-auto form-empresas border rounded-b-lg">
        <div class="bg-blue-700 h-14 flex items-center border rounded-t-lg">
            <h2 class="ml-5 mb-4 pt-4 text-xl  text-white dark:text-white"><i class="fa-solid fa-file-pen mr-2 text-2xl"></i>Editar Empresa</h2>
        </div>
        @if (session('info'))
        <div id="alertMessage" class="p-4 mb-4 text-sm text-blue-700 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
            <span class="font-medium">{{(session('info'))}}</span>
        </div>
        @endif
        <div class="py-8 px-4 mx-auto max-w-2xl lg:pb-16">
            
            {!! Form::model($empresa, ['route' => ['empresa.update', $empresa->id], 'method' => 'PUT']) !!}
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        {!! Form::label('name', 'Nombre Empresa',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
                        {!! Form::text('name', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Nombre de la empresa']) !!}
                        @error('name')
                        <span class="text-red-500 text-sm">{{$message}}</span>     
                        @enderror
                    </div>

                    <div class="w-full">
                        {!! Form::label('nit', 'NIT',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
                        {!! Form::number('nit', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Ingrese el nit...']) !!}
                        @error('nit')
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
                    <div class="w-full">
                        {!! Form::label('celular', 'Celular',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
                        {!! Form::number('celular', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Celular...']) !!}
                        @error('celular')
                        <span class="text-red-500 text-sm">{{$message}}</span>     
                        @enderror
                    </div>
                    <div>
                        {!! Form::label('sede', 'Sede',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
                        {!! Form::select('sede', $sedesAsociadas, null, ['id' => 'sede', 'class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Seleccione la sede..']) !!}
                        @error('sede')
                        <span class="text-red-500 text-sm">{{$message}}</span>     
                        @enderror
                    </div>
                    <div>
                        {!! Form::label('direccion', 'Dirección',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
                        {!! Form::text('direccion', null, ['id' => 'direccion', 'class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Dirección...']) !!}
                        @error('direccion')
                        <span class="text-red-500 text-sm">{{$message}}</span>     
                        @enderror
                    </div>
                    <div>
                        {!! Form::label('barrio', 'Barrio',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
                        {!! Form::text('barrio', null, ['id' => 'barrio','class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Barrio...']) !!}
                        @error('barrio')
                        <span class="text-red-500 text-sm">{{$message}}</span>     
                        @enderror
                    </div>
                    <div>
                        {!! Form::label('ciudad', 'Ciudad',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
                        {!! Form::text('ciudad', null, ['id' => 'ciudad', 'class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Ciudad...']) !!}
                        @error('ciudad')
                        <span class="text-red-500 text-sm">{{$message}}</span>     
                        @enderror
                    </div>
                    <div>
                        {!! Form::label('geoubicacion', 'Geoubicacion',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
                        {!! Form::text('geoubicacion', null, ['id' => 'geoubicacion','class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Geoubicación de la sede..']) !!}
                        @error('geoubicacion')
                        <span class="text-red-500 text-sm">{{$message}}</span>     
                        @enderror
                    </div>
                    <div class="w-full">
                        {!! Form::label('telefono_sede', 'Telefono/Sede',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
                        {!! Form::number('telefono_sede', null, ['id' => 'telefono_sede','class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Celular...']) !!}
                        @error('telefono_sede')
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
                        {!! Form::label('estado_empresa', 'Estado Empresa',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
                        {!! Form::select('estado_empresa', ['Activa' => 'Activa', 'Inactiva' => 'Inactiva'], null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Estado empresa']) !!}
                        @error('estado_empresa')
                        <span class="text-red-500 text-sm">{{$message}}</span>     
                        @enderror
                    </div> 
                    
                </div>
                
                {!! Form::submit('Actualizar Empresa', ['class' => 'inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800']) !!}
                
            {!! Form::close() !!}
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
        
        $(document).ready(function(){
        $('#sede').change(function(){
        var sedeId = $(this).val();
        $.ajax({
            url: '/obtener-datos-sede/' + sedeId,
            type: 'GET',
            dataType: 'json',
            success: function(data){
                $('#direccion').val(data.direccion);
                $('#barrio').val(data.barrio);
                $('#ciudad').val(data.ciudad);
                $('#geoubicacion').val(data.geoubicacion);
                $('#telefono_sede').val(data.telefono_sede);
            },
            error: function(xhr, status, error){
                console.error(error);
            }
        });
    });
});
      </script>
</x-app-layout>