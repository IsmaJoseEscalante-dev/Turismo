@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <h1>Paradas</h1>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <tbody>
                <tr>
                    <td colspan="2" class="text-center font-weight-bold">Datos de la parada</td>
                </tr>
                <tr>
                    <th>ID</th>
                    <td>{{ $station->id }}</td>
                </tr>
                <tr>
                    <th>Tour</th>
                    <td>{{ $station->tour->name }}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{ $station->name }}</td>
                </tr>
                <tr>
                    <th>Image</th>
                    <td>
                        @foreach($station->images as $image)
                            <img class="rounded border shadow-sm" src="{{ Storage::url($image->image) }}" height="150"
                                 width="150">
                        @endforeach
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-primary"
                   href="{{ route('station.index',$station->tour_id) }}">
                    Volver
                </a>
            </div>
        </div>
    </div>
@endsection
