<x-app-layout>
    @include('layouts.content')
    <section class=" bg-white dark:bg-gray-900 mx-5 overflow-auto form-empresas border rounded-b-lg">
        <div class="bg-blue-700 h-14 flex items-center border rounded-t-lg">
            <h2 class="ml-5 mb-4 pt-4 text-xl  text-white dark:text-white"><i class="fa-solid fa-user mr-2 text-2xl"></i>Creación de Usuarios</h2>
        </div>
        <div class="py-8 px-4 mx-auto max-w-2xl lg:pb-16">
            
    {!! Form::open(['route' => 'users.store']) !!}
     <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
    <div class="sm:col-span-2">
        {!! Form::label('name', 'Nombre',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
        {!! Form::text('name', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Ingresar nombres completos']) !!}
        @error('name')
        <span class="text-red-500 text-sm">{{$message}}</span>     
        @enderror
    </div>

    <div>
        {!! Form::label('apellidos', 'Apellidos',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
        {!! Form::text('apellidos', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Ingresar apellidos completos']) !!}
        @error('apellidos')
        <span class="text-red-500 text-sm">{{$message}}</span>     
        @enderror
    </div>
    <div class="w-full">
        {!! Form::label('identificacion', 'Identificación',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
        {!! Form::number('identificacion', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Ingrese la identificación del usuario']) !!}
        @error('identificacion')
        <span class="text-red-500 text-sm">{{$message}}</span>     
        @enderror
    </div>
    <div>
        {!! Form::label('telefono','Telefono',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
        {!! Form::number('telefono', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Número Telefónico']) !!}
        @error('telefono')
        <span class="text-red-500 text-sm">{{$message}}</span>     
        @enderror
    </div>
    <div>
        {!! Form::label('email', 'Correo Eléctronico',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
        {!! Form::text('email', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Correo Electrónico o E-mail']) !!}
        @error('email')
        <span class="text-red-500 text-sm">{{$message}}</span>     
        @enderror
    </div>
    <div>
        {!! Form::label('perfil', 'Perfil',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
        {!! Form::select('perfil', ['Admin Sistemas' => 'Admin Sistemas', 'Gerente' => 'Gerente', 'Jefe de area' => 'Jefe de area', 'Coor. Area' => 'Coor. Area', 'Asesor' => 'Asesor'], null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500']) !!}
        @error('perfil')
        <span class="text-red-500 text-sm">{{$message}}</span>     
        @enderror
    </div>
    <div class="w-full">
        {!! Form::label('area', 'Area Laboral',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
        {!! Form::select('area', ['Comercial y mercadeo' => 'Comercial y mercadeo', 'Aportes' => 'Aportes', 'Empleo' => 'Empleo', 'Afiliaciones' => 'Afiliaciones'], null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500']) !!}
        @error('area')
        <span class="text-red-500 text-sm">{{$message}}</span>     
        @enderror
    </div>
    <div>
        {!! Form::label('sede','Sede / Regional',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
        {!! Form::select('sede', $sedes->pluck('nombre_sede', 'id'), null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Sede del Usuario']) !!}
        @error('sede')
        <span class="text-red-500 text-sm">{{$message}}</span>     
        @enderror
    </div> 
    <div class="w-full">
        {!! Form::label('usuario', 'Usuario',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
        {!! Form::text('usuario', null, ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Usuario']) !!}
        @error('usuario')
        <span class="text-red-500 text-sm">{{$message}}</span>     
        @enderror
    </div>
    <div>
        {!! Form::label('password', 'Contraseña',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
        {!! Form::password('password',['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Contraseña..']) !!}
        @error('password')
        <span class="text-red-500 text-sm">{{$message}}</span>     
        @enderror
    </div>
    <div>
        {!! Form::label('password_confirmation', 'Repetir contraseña',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
        {!! Form::password('password_confirmation', ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500', 'placeholder' => 'Repetir contraseña']) !!}
        @error('password')
        <span class="text-red-500 text-sm">{{$message}}</span>     
        @enderror
    </div>
    <div>
        {!! Form::label('foto', 'Subir Foto',['class' => 'block mb-2 text-sm font-medium text-blue-700 dark:text-white']) !!}
        {!! Form::file('foto', ['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500']) !!}
        @error('cargo_rep_legal')
        <span class="text-red-500 text-sm">{{$message}}</span>     
        @enderror
    </div>
    {!! Form::hidden('nmv_cliente_id', auth()->user()->nmv_cliente_id) !!}
    {!! Form::submit('Crear Usuario', ['class' => 'inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800']) !!}
                
    {!! Form::close() !!}
    </div>
    </section>
</x-app-layout>