@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <h3>Crear Categorias</h3>
    <div class="content">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Nombre</label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" class="form-control">
                        @error('name')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Descripción</label><br>
                        <textarea class="form-control" name="description" id="description" rows="3">{{  old('description') }}</textarea>
                        @error('description')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="/css/admin_custom.css">
@endsection
