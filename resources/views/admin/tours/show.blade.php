@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="containerpy-4">
        <h3>EXCURSION {{ $tour->name }}</h3>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered ">
                <tr>
                    <th>Nombre</th>
                    <td>{{ $tour->name }}</td>
                </tr>
                <tr>
                    <th>Categoria</th>
                    <td>{{ $tour->category->name }}</td>
                </tr>
                <tr>
                    <th>Precio</th>
                    <td>{{ $tour->amount }}</td>
                </tr>
                <tr>
                    <th>Imagen</th>
                    <td>
                        <img src="{{ Storage::url($tour->image->image) }}" alt="image" width="100px">
                    </td>
                </tr>
                 <tr>
                    <th>Estaciones</th>
                    <td>
                        <ul>
                            @foreach ($tour->stations as $station)
                                <li>{{ $station->name }}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
                <tr>
                    <th>Descripción Tour</th>
                    <td>{!! $tour->description_tour !!}</td>
                </tr>
                <tr>
                    <th>Descripción de Lugares</th>
                    <td>{!! $tour->description_place !!}</td>
                </tr>
                <tr>
                    <th>Servicios</th>
                    <td>{!! $tour->services !!}</td>
                </tr>
                <tr>
                    <th>Itinerario</th>
                    <td>{!! $tour->itinerario !!}</td>
                </tr>
                <tr>
                    <th>Tips</th>
                    <td>{!! $tour->tips !!}</td>
                </tr>
            </table>
            <div class="pt-3">
                <a href="{{ route('tours.index') }}" class="btn btn-secondary">Regresar</a>
            </div>
        </div>
    </div>
@endsection
