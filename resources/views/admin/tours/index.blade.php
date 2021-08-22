@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="container d-flex justify-content-between py-4">
        <h3>EXCURSIONES</h3>
        <a href="tours/create" class="btn btn-primary">CREAR</a>
    </div>
    <div class="card">
        <div class="card-body">
            <table id="tours" class="table table-striped shadow-lg mt-4" style="width:100%">
                <thead class="bg-primary text-white">
                <th scope="col">ID</th>
                <th scope="col">nombre</th>
                <th scope="col">Categoria</th>
                <th scope="col">Image</th>
                <th scope="col">Precio</th>
                <th scope="col">Acciones</th>
                </thead>
                <tbody>
                @foreach($tours as $tour)
                    <tr>
                        <td>{{$tour->id}}</td>
                        <td>{{$tour->name}}</td>
                        <td>{{$tour->category->name}}</td>
                        <td>
                        @if($tour->image)
                            <img width = "40px" height= '40px'
                            src="{{ Storage::url($tour->image->image) }}"  alt="">
                        @endif
                        </td>
                        <td>{{$tour->amount}}</td>
                        <td>
                            <form action="{{route('tours.destroy',$tour->id)}}" method="post">
                                <a href="tours/{{$tour->id}}/edit" class="btn btn-info">Editar</a>
                                <a href="{{ route('station.index', $tour->id) }}" class="btn btn-success">Paradas</a>
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

@section('styles')
    <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#tours').DataTable({
                "lengthMenu": [[5, 10, 50, -1], [5, 10, 50, 'All']]
            });
        });
    </script>
@stop


