<x-app-layout>
    @include('layouts.content')
    
    <section class="bg-white dark:bg-gray-900 mx-5 overflow-auto border rounded-t-lg rounded-b-lg">
        <div class="bg-blue-700 h-14 flex items-center border rounded-t-lg">
            <h2 class="ml-5 mb-4 pt-4 text-xl  text-white dark:text-white"><i class="fa-solid fa-flag-checkered mr-2"></i>Reportes</h2>
        </div>
    
        <form action="{{ route('reportes.index') }}" method="GET" class=" mt-7">
            <div class="flex justify-center">
                <label for="fecha_cita" class=" pt-3 text-sm font-medium text-blue-700 dark:text-white">Fecha inicial:</label>
                <input type="date" id="fecha_cita" name="fecha_cita" class=" h-10 w-3/5 bg-gray-50 ml-3 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
            </div>
            <div class="flex justify-center">
                    <label for="fecha_cita" class=" mt-3 pt-3 text-sm font-medium text-blue-700 dark:text-white">Fecha Final:</label>
                    <input type="date" id="fecha_cita" name="fecha_cita" class="  mt-3 h-10 w-3/5 bg-gray-50 ml-5 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"> 
            </div>
            <div class="flex justify-center">
                <label for="fecha_cita" class=" mt-3 pt-3 text-sm font-medium text-blue-700 dark:text-white">Identificación del usuario:</label>
                <input type="date" id="fecha_cita" name="fecha_cita" class=" mr-20 mt-3 h-10 w-3/5 bg-gray-50 ml-3 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
            </div>
            <div class="flex justify-center mt-5 mb-5">
                <button type="submit" class="ml-3 px-5 py-2.5  text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">Buscar</button>
            </div>
        </form>
    </section>
</x-app-layout>