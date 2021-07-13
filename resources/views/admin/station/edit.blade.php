@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>MODIFICAR EXCURSION</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action='/station/{{$station->id}}' method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="" class="form-label">Nombre</label>
                <input id="name" name="name" type="text" class="form-control" value = "{{$station->name}}">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Descripción</label><br>
                <textarea class="form-control" name="description" rows="6">{{$station->description}}</textarea>
            </div>
            <a href="/station" class="btn btn-secondary" tabindex="5">Cancelar</a>
            <button type="submit" class="btn btn-primary" tabindex="4">Guardar</button>
        </form>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop
