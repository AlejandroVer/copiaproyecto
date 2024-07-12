<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Sucursal</th>
            <th>Razón</th>
            <th>Sede</th>
            <th>Dirección</th>
            <th>Barrio</th>
            <th>Ubicación</th>
        </tr>
    </thead>
    <tbody>
        @foreach($empresas as $empresa)
            <tr>
                <td>{{ $empresa->id }}</td>
                <td>{{ $empresa->ciudad }}</td>
                <td>{{ $empresa->name }}</td>
                <td>{{ $empresa->nombre_sede }}</td>
                <td>{{ $empresa->direccion }}</td>
                <td>{{ $empresa->barrio }}</td>
                <td>{{ $empresa->geoubicacion }}</td>
            </tr>
        @endforeach
    </tbody>
</table>