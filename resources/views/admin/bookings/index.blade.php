@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="container d-flex justify-content-between py-4">
        <h3>Reservas</h3>
        <a href="bookings/create" class="btn btn-primary">CREAR</a>
    </div>
    <div class="card">
        <div class="card-body">
            <table id="bookings" class="table table-striped shadow-lg mt-4" style="width:100%">
                <thead class="bg-primary text-white">
                <th scope="col">ID</th>
                <th scope="col">nombre</th>
                <th scope="col">Image</th>
                <th scope="col">Precio</th>
                <th scope="col">Acciones</th>
                </thead>
                <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{$booking->id}}</td>
                        <td>{{$booking->name}}</td>
                        <td>
                        @if($booking->image)
                            <img width = "40px" height= '40px'
                            src="{{ Storage::url($booking->image->image) }}"  alt="">
                        @endif
                        </td>
                        <td>{{$booking->amount}}</td>
                        <td>
                            <form action="{{route('bookings.destroy',$booking->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <a href="bookings/{{$booking->id}}" class="btn btn-info">Ver</a>
                                <a href="bookings/{{$booking->id}}/edit" class="btn btn-warning">Editar</a>
                                <button type="submit" class="btn btn-danger">Borrar</button>
                            </form>
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
        $(document).ready(function () {
            $('#bookings').DataTable({
                "lengthMenu": [[5, 10, 50, -1], [5, 10, 50, 'All']]
            });
        });
    </script>
@endsection


