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
                <th scope="col">Fecha</th>
                <th scope="col">Estado</th>
                <th scope="col">Total</th>
                <th scope="col">Acciones</th>
                </thead>
                <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{$booking->id}}</td>
                        <td>{{$booking->date}}</td>
                        <td>{{$booking->status}}</td>
                        <td>{{$booking->total}}</td>
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
