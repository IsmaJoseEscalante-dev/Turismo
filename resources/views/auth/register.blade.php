@extends('layouts.app')

@section('css')
    <style>
        .fa-user{
            font-size:60px;
            color:#14505C !important;
        }
    </style>
@endsection

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                <h2 class="text-center"><i class="fas fa-user"></i></h2>
                    <h3 class="text-center py-3"><B>REGISTRARSE</B></h3>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-8 mx-auto">
                                <input id="name" type="text" class="form-control bg-light shadow-sm border-0 @error('name')is-invalid @else border-0 @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Nombre" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-8 mx-auto">
                                <input id="email" type="email" class="form-control bg-light shadow-sm border-0 bg-light shadow-sm @error('email')is-invalid @else border-0 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-8 mx-auto">
                                <input id="password" type="password" class="form-control bg-light shadow-sm border-0 @error('password')is-invalid @else border-0 @enderror" name="password" required autocomplete="new-password" placeholder="Contrase??a">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-8 mx-auto">
                                <input id="password-confirm" type="password" class="form-control bg-light shadow-sm border-0" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmar Contrase??a">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-2">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
