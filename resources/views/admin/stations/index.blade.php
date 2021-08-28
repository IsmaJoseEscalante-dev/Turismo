@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="container d-flex justify-content-between py-4">
        <h3>Lugares Turisticos</h3>
        <a href="stations/create" class="btn btn-primary">CREAR</a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
            </div>
            <table id="station" class="table table-striped shadow-lg mt-4" style="width:100%">
                <thead class="bg-primary text-white">
                <th scope="col">ID</th>
                <th scope="col">nombre</th>
                <th scope="col">Descripción</th>
                <th scope="col">Image</th>
                <th scope="col">Acciones</th>
                </thead>
                <tbody>
                @foreach($stations as $station)
                    <tr>
                        <td>{{ $loop->iteration  }}</td>
                        <td>{{$station->name}}</td>
                        <td>{{$station->description}}</td>
                        <td>
                            @foreach($station->images as $image)
                                @if($loop->iteration == 1)
                                    <img src="{{ Storage::url($image->image) }}" alt="" width="60px">
                                @endif
                            @endforeach
                        </td>
                        <td>
                            <form action="{{route('stations.destroy',$station->id)}}" method="post">
                                <a href="{{ route('stations.show', $station->id) }}" class="btn btn-info">Ver</a>
                                <a href="{{ route('stations.edit', $station->id) }}" class="btn btn-warning">Editar</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Borrar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('style')
    <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@stop

@section('js')
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#station').DataTable({
                "lengthMenu": [[5, 10, 50, -1], [5, 10, 50, 'All']]
            });
        });
    </script>
@stop
