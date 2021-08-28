@extends('layouts.admin')

@section('title', 'Promocion')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Titulo</th>
                        <td>{{ $promotion->name }}</td>
                    </tr>
                    <tr>
                        <th>Precio</th>
                        <td>{{ $promotion->amount }}</td>
                    </tr>
                    <tr>
                        <th>Descuento</th>
                        <td>{{ $promotion->discount }}</td>
                    </tr>
                    <tr>
                        <th>Fecha de incio</th>
                        <td>{{ $promotion->date_start }}</td>
                    </tr>
                    <tr>
                        <th>Fecha de finalizacion</th>
                        <td>{{ $promotion->date_finish }}</td>
                    </tr>
                    <tr>
                        <th>Descripcion</th>
                        <td>{{ $promotion->description }}</td>
                    </tr>
                    <tr>
                        <th>Estado</th>
                        <td>{{ $promotion->status }}</td>
                    </tr>
                    <tr>
                        <th>Tours</th>
                        <td>
                            @foreach($promotion->tours as $tour)
                                {{ $tour->name }} <br>
                            @endforeach
                        </td>
                    </tr>
                </table>
                <div class="form-group pt-3">
                    <a href="{{ route('promotions.index') }}" class="btn btn-secondary">Regresar</a>
                </div>
            </div>
        </div>
    </div>
@endsection



