@extends('layouts.app')

@section('content')
    <div class="container my-3">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center">Reserva</h3>
                        <table class="table table-bordered">
                            <tr>
                                <th>Destino</th>
                                <td>{{ $booking->title }}</td>
                            </tr>
                            <tr>
                                <th>Fecha de reserva</th>
                                <td>{{ $booking->created_at }}</td>
                            </tr>
                            <tr>
                                <th>Fecha de salida</th>
                                <td>{{ $booking->date }}</td>
                            </tr>
                            <tr>
                                <th>Tipo de reserva</th>
                                <td>{{ $booking->type_booking }}</td>
                            </tr>
                            <tr>
                                <th>Pasajeros</th>
                                <td>
                                @foreach ($passengers as $passenger)
                                    <p>{{ $passenger->name }} {{ $passenger->lastName }}</p>
                                @endforeach
                                </td>
                            </tr>
                            <tr>
                                <th>Total pagado</th>
                                <td>{{ $booking->total }} $</td>
                            </tr>
                        </table>
                        <div class="form-group mb-0">
                            <a href="{{ route('home') }}" class="btn btn-primary">Regresar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
