@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <h1>Paradas</h1>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <tbody>
                <tr>
                    <td colspan="2" class="text-center font-weight-bold">Datos de la Reserva</td>
                </tr>
                <tr>
                    <th>ID</th>
                    <td>{{ $booking->id }}</td>
                </tr>
                <tr>
                    <th>Fecha de reserva</th>
                    <td>{{ $booking->date}}</td>
                </tr>
                <tr>
                    <th>Estado</th>
                    <td>{{ $booking->status}}</td>
                </tr>
                <tr>
                    <th>Monto Total</th>
                    <td>{{ $station->description }}</td>
                </tr>
                </tbody>
            </table>
             <div class="form-group">
                <a class="btn btn-primary" href="{{ route('stations.index') }}">Volver</a>
            </div>
        </div>
    </div>
@endsection
