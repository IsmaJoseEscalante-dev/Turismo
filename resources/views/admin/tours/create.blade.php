@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h3>CREAR EXCURSIONES</h3>
@stop

@section('content')
<div class="content">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('tours.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Nombre</label>
                    <input id="name" name="name" type="text" class="form-control" tabindex="1">
                    @error('name')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Precio</label><br>
                    <input id="amount" name="amount" type="number" class="form-control" tabindex="3">
                    @error('amount')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Descripción</label><br>
                    <textarea class="form-control" name="description" id="description" rows="6"></textarea>
                    @error('description')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <a href="/tours" class="btn btn-secondary" tabindex="5">Cancelar</a>
                <button type="submit" class="btn btn-primary" tabindex="4">Guardar</button>
            </form>
        </div>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
