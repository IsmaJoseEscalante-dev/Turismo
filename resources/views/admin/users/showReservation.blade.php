@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="container py-4">
        <h3>Carrito</h3>
    </div>
    <div class="card">
        <div class="card-body">
            <table id="bookings" class="table table-striped shadow-lg mt-4" style="width:100%">
                <thead class="bg-primary text-white">
                    <th scope="col">ID</th>
                    <th scope="col">Lugar</th>
                    <th scope="col">Total pagado</th>
                    <th scope="col">Tipo de reserva</th>
                    <th scope="col">Fecha</th>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                        <tr>
                            <td>{{ $booking->id }}</td>
                            <td>{{ $booking->title }}</td>
                            <td>{{ $booking->total }} $</td>
                            <td>{{ $booking->type_booking }}</td>
                            <td>{{ $booking->date }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="form-group my-3">
                <a href="{{ route('users.index') }}" class="btn btn-primary">Regresar</a>
            </div>
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
            $('#bookings').DataTable({
                "lengthMenu": [
                    [5, 10, 50, -1],
                    [5, 10, 50, 'All']
                ]
            });
        });
    </script>
@endsection
