@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="container py-4">
        <h3>Editar datos del administrador</h3>
        <div class="card">
            <div class="card-body">
                <h3>Editar datos</h3>
                <hr>
                <form action="{{ route('users.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Nombre *</label>
                            <input type="text" name="name" class="form-control"
                                value="{{ old('name', Auth::user()->name) }}">
                            @error('name')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>Apellidos *</label>
                            <input type="text" name="lastName" class="form-control"
                                value="{{ old('lastName', Auth::user()->lastName) }}">
                            @error('lastName')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>Email *</label>
                            <input type="email" name="email" class="form-control"
                                value="{{ old('email', Auth::user()->email) }}">
                            @error('email')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>Telefono *</label>
                            <input type="number" name="phone" class="form-control"
                                value="{{ old('phone', Auth::user()->phone) }}">
                            @error('phone')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-12">
                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4>Cambiar contraseña</h4>
                <hr>
                <form action="{{ route('users.password') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label>Nueva contraseña</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Repetir contraseña</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>
                        <div class="form-group col-12">
                            <button type="submit" class="btn btn-primary">Cambiar contraseña</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
