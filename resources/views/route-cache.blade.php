<h6 class="mt-4">Route Caching List</h6>
<table class="table table-striped mt-4">
    <thead>
        <tr>
            <th>Middleware</th>
            <th>Name</th>
            <th>Path</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($routeCache as $route)
        <tr>
            <td>{{ $route['middleware'] }}</td>
            <td>{{ $route['name'] }}</td>
            <td>{{ $route['path'] }}</td>
            <td>{{ $route['action'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
