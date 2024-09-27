<table>
    <thead>
    <tr>
        <th>Estado</th>
        <th>Lider de Seguimiento</th>
        <th>Instancia que Remite</th>
        <th>Municipio del Caso</th>
        <th>Actividad de la Víctima / Sobreviviente </th>
        <th>Tipo de Violencia</th>
        <th>Ámbito de Violencia</th>
        <th>Fecha del Hecho</th>
    </tr>
    </thead>
    <tbody>
    @foreach($informacion as $info)
        <tr>
            <td>{{ $info->estado_referencia }}</td>
            <td>{{ $info->name }}</td>
            <td>{{ $info->instancia_remite }}</td>
            <td>{{ $info->nombre_municipio }}</td>
            <td>{{ $info->actividad }}</td>
            <td>{{ $info->violencia }}</td>
            <td>{{ $info->ambito }}</td>
            <td>{{ $info->fecha_hecho }}</td>
        </tr>
    @endforeach
    </tbody>
</table> 
