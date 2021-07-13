@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>MODIFICAR EXCURSION</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('tours.update', $tour) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="" class="form-label">Nombre</label>
                <input id="name" name="name" type="text" class="form-control" value = "{{$tour->name}}">
                @error('name')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Precio</label><br>
                <input id="amount" name="amount" type="number" class="form-control" value = "{{$tour->amount}}">
                @error('amount')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Descripción</label><br>
                <textarea class="form-control" name="description" id="description" rows="6">{{ $tour->description }}</textarea>
                @error('description')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <a href="{{ route('tours.index') }}" class="btn btn-secondary" tabindex="5">Cancelar</a>
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
