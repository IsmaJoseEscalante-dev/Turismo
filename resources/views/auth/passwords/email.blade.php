@extends('layouts.app')

@section('css')
    <style>
        .fa-lock{
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
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h2 class="text-center"><i class="fas fa-lock"></i></h2>
                    <h3 class="text-center py-3"><B>Reseteo de contraseña</B></h3>
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-8 mx-auto">
                                <input id="email" type="email" class="form-control bg-light shadow-sm border-0 @error('email')is-invalid @else border-0 @enderror" name="email" value="{{ old('email') }}" placeholder="Correo electrónico" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
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
