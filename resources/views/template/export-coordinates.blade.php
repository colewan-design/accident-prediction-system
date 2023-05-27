<table>
    <thead>
    <tr>
        <th>Latitude</th>
        <th>Longitude</th>
        <th>Location</th>
    </tr>
    </thead>
    <tbody>
    @foreach($coordinates as $coordinate)
        <tr>
            <td>{{ $coordinate->latitude }}</td>
            <td>{{ $coordinate->longitude }}</td>
            <td>{{ $coordinate->location }}</td>
        </tr>
    @endforeach
    </tbody>
</table>