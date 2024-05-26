<x-app-layout>
    @include('layouts.content')
    
    <section class="bg-white dark:bg-gray-900 mx-5 overflow-auto border rounded-t-lg rounded-b-lg">
        <div class="bg-blue-700 h-14 flex items-center border rounded-t-lg">
            <h2 class="ml-5 mb-4 pt-4 text-xl  text-white dark:text-white"><i class="fa-solid fa-pen-to-square mr-2"></i>Actualización de empresas</h2>
        </div>
    <form class="max-w-lg mx-auto my-5" action="{{ route('empresa.index') }}" method="GET">
        <div class="flex justify-center">
            <div class="relative w-80 md:w-full lg:w-full rounded-e-lg border">
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

    @if (!empty($query))
        <div class="max-w-lg ml-5 my-5">
            <a href="{{ URL::previous() }}" class="bg-blue-700 hover:bg-blue-800 text-white  text-sm py-2 px-4 rounded">Volver</a>
        </div>
    @endif

    @if (session('info'))
    <div id="alertMessage" class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
        <span class="font-medium">{{(session('info'))}}</span>
    </div>
    @endif  

{{-- @if ($query != '') --}}
<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                    Razon
                </th>
                <th scope="col" class="px-6 py-3">
                    NIT
                </th>
                <th scope="col" class="px-6 py-3">
                    Rep.Legal
                </th>
                <th scope="col" class="px-6 py-3">
                    Estado
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
                <td class="px-6 py-4">
                    {{$empresa->name}}
                </td>
                <td class="px-6 py-4">
                    {{$empresa->nit}}
                </td>
                <td class="px-6 py-4">
                    {{$empresa->rep_legal}}
                </td>
                <td class="px-6 py-4">
                    {{$empresa->estado}}
                </td>
                <td class="">
                    @can('empresa.edit')
                    <a href="{{route('empresa.edit', $empresa->id)}}" class="text-white py-2 px-2 bg-blue-700 hover:bg-blue-800 w-12 h-7 border rounded-lg">Editar</a>
                    @endcan
                        
                     
                </td>
                <td>
                    @can('empresa.destroy')
                    <form id="deleteForm{{ $empresa->id }}" action="{{route('empresa.destroy', $empresa->id)}}" method="POST" class="">
                        @csrf
                        @method('delete')
                        <button type="submit" class="text-white text-center px-2 bg-red-500 hover:bg-red-600 w-18 h-8  border rounded-lg" value="eliminar">Eliminar</button>
                        </form>
                    @endcan
                        
                     
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    {{$empresas->links()}}
</div>
{{-- @endif --}}
      
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