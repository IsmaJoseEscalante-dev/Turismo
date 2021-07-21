@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <h1>Crear Lugar Turistico</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('station.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Nombre</label>
                    <input id="name" name="name" type="text" class="form-control" tabindex="1">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Descripción</label><br>
                    <input id="description" name="description" type="text" class="form-control" tabindex="2">
                </div>
                <input type="hidden" name="tour_id" value="{{ $tour->id }}">

                <a href="{{ route('station.index',$tour->id) }}" class="btn btn-secondary" tabindex="5">Cancelar</a>
                <button type="submit" class="btn btn-primary" tabindex="4">Guardar</button>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
