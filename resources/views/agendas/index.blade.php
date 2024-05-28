<x-app-layout>
    @include('layouts.content')

<section class="bg-white dark:bg-gray-900 mx-5 overflow-auto border rounded-t-lg rounded-b-lg">
    <div class="bg-blue-700 h-14 flex items-center border rounded-t-lg">
        <h2 class="ml-5 mb-4 pt-4 text-xl text-white dark:text-white">
            <i class="fa-regular fa-calendar-days mr-2"></i>Control de agendas
        </h2>
    </div>

    <form action="{{ route('agendas.index') }}" method="GET" class="mt-7">
        <div class="flex justify-center">
            <label for="fecha_cita" class="pt-3 text-sm font-medium text-blue-700 dark:text-white">
                Buscar por fecha de agenda:
            </label>
            <input type="date" id="fecha_cita" name="fecha_cita" class="h-10 w-3/5 bg-gray-50 ml-3 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
        </div>
        <div class="flex justify-center mt-3">
            <button type="submit" class="ml-3 px-5 py-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">Buscar</button>
        </div>
    </form>

    @if(isset($agendas))
        @if($agendas->isEmpty())
            <p class="text-gray-700">No se han encontrado resultados para la fecha seleccionada.</p>
        @else
            <div class="relative overflow-x-auto flex justify-center">
                <table class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 mt-5">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Fecha y Hora</th>
                            <th scope="col" class="px-6 py-3">Razón</th>
                            <th scope="col" class="px-6 py-3">SEDE</th>
                            <th scope="col" class="px-6 py-3">Dirección</th>
                            <th scope="col" class="px-6 py-3">Ciudad</th>
                            <th scope="col" class="px-6 py-3">Motivo Visita</th>
                            <th scope="col" class="px-6 py-3">Estado</th>
                            <th scope="col" class="px-6 py-3">Agendada el</th>
                            <th scope="col" class="px-6 py-3">Ubicacion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($agendas as $agenda)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $agenda->fecha_cita }} / {{ date('h:i', strtotime($agenda->hora_cita)) }} {{ date('a', strtotime($agenda->hora_cita)) }}
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $agenda->name }}
                                </td>
                                <td class="px-6 py-4">{{ $agenda->nombre_sede }}</td>
                                <td class="px-6 py-4">{{ $agenda->direccion }}</td>
                                <td class="px-6 py-4">{{ $agenda->ciudad }}</td>
                                <td class="px-6 py-4">{{ $agenda->objetivo_visita }}</td>
                                <td class="px-6 py-4">{{ $agenda->sedeEmpresa->estado}}</td>
                                <td class="px-6 py-4">{{ $agenda->created_at->format('Y-m-d') }}</td>
                                <td class="px-6 py-4">
                                    @php
                                        $geoubicacion = $agenda->sedeEmpresa->geoubicacion;
                                        $geoubicacionUrl = str_replace(' ', '', $geoubicacion);
                                    @endphp
                                    <a class="text-green-700" href="https://www.google.com/maps/search/?api=1&query={{ $geoubicacionUrl }}" target="_blank">Ver mapa</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $agendas->links() }}
            </div>
            <div id="map-container" style="width: 100%; height: 400px; margin-top: 20px;"></div>
        @endif
    @endif
</section>   

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBH0YQciQm1UWewgAW8uP6ChxLa3MksHXU&callback=initMap"></script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBH0YQciQm1UWewgAW8uP6ChxLa3MksHXU&callback=initMap"></script>
<script>

    var map;
    var markers = [];

    function initMap(){
        map = new google.maps.Map(document.getElementById('map-container'), {
            zoom: 14,
            center: {lat: 4.134282, lng: -73.637742}
        });

        var sedeCoordinates = {!! json_encode($sedeCoordinates) !!};
        addMarkers(sedeCoordinates);
    }

    function addMarkers(sedeCoordinates) {
        clearMarkers();
        sedeCoordinates.forEach(function(coordinate){
            var parts = coordinate.split(',');
            var lat = parseFloat(parts[0]);
            var lng = parseFloat(parts[1]);

            var marker = new google.maps.Marker({
                position: {lat: lat, lng: lng},
                map: map
            });
            markers.push(marker);
        });

        if (sedeCoordinates.length > 0) {
            var parts = sedeCoordinates[0].split(',');
            var lat = parseFloat(parts[0]);
            var lng = parseFloat(parts[1]);
            map.setCenter({lat: lat, lng: lng});         
        }
    }

    function clearMarkers() {
        markers.forEach(function(marker) {
            marker.setMap(null);
        });
        markers = [];   
    }

    document.getElementById('searchForm').addEventListenner('submit', function(event){
        event.preventDefault();

        var formData = new FormData(this);
        var searchParams = new URLSearchParams(formData).toString();    

        fetch('{{ route("agendas.index") }}?' + searchParams)
        .then(response => response.json())
        .then(data => {
            updateTable(data.agendas);
            updateMap(data.sedeCoordinates);
        });
    });

    function updateTable(agendas) {

    }

    function updateMap(sedeCoordinates) {
        addMarkers(sedeCoordinates);
    }
    
</script>

</x-app-layout>