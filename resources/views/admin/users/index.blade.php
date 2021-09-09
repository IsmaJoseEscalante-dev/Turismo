@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="container d-flex justify-content-between py-4">
        <h3>Usuarios</h3>
    </div>
    <div class="card">
        <div class="card-body">
            <table id="users" class="table table-striped shadow-lg mt-4" style="width:100%">
                <thead class="bg-primary text-white">
                    <th scope="col">ID</th>
                    <th scope="col">nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Celular</th>
                    <th scope="col">Email</th>
                    <th scope="col">Acciones</th>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->lastName }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <a href="{{ route('users.showCart', $user) }}" class="btn btn-light">Ver Carro</a>
                                <a href="{{ route('usersAdmin.booking', $user) }}" class="btn btn-light">Ver Reservas</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('style')
    <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#users').DataTable({
                "lengthMenu": [
                    [5, 10, 50, -1],
                    [5, 10, 50, 'All']
                ]
            });
        });
    </script>
@endsection
