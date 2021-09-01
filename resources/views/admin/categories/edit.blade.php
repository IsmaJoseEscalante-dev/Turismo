@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <h3>Modificar Categoria</h3>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('categories.update', $category) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="" class="form-label">Nombre</label>
                    <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $category->name) }}">
                    @error('name')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Descripción</label><br>
                    <textarea class="form-control" name="description" id="description"
                              rows="3">{{ old('description', $category->description) }}</textarea>
                    @error('description')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary" tabindex="4">Actualizar</button>
            </form>
        </div>
    </div>
@endsection
