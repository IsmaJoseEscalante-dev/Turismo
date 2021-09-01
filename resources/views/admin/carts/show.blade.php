@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="container d-flex justify-content-between py-4">
        <h3>Reservas</h3>
        <a href="carts/create" class="btn btn-primary">CREAR</a>
    </div>
    <div class="card">
        <div class="card-body">
            <table id="carts" class="table table-striped shadow-lg mt-4" style="width:100%">
                <thead class="bg-primary text-white">
                    <th scope="col">ID</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Id</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Tipo de reserva</th>
                </thead>
                <tbody>
                    @foreach ($carts as $cart)
                        <tr>
                            <td>{{ $cart->id }}</td>
                            <td>{{ $cart->date }}</td>
                            <td>{{ $cart->quantity }}</td>
                            <td>{{ $cart->status }}</td>
                            <td>{{ $cart->user_id }}</td>
                            <td>{{ $cart->user->name }}</td>
                            <td>{{ $cart->cartable_type }}</td>
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
            $('#carts').DataTable({
                "lengthMenu": [
                    [5, 10, 50, -1],
                    [5, 10, 50, 'All']
                ]
            });
        });
    </script>
@endsection
