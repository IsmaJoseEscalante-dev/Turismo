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
                    {{-- <h3 class="text-center">A'lli Turismo</h3> --}}
                    <h3 class="text-center py-3"><B>LOGIN</B></h3>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-8 mx-auto">
                                <input id="email" type="email" class="form-control bg-light shadow-sm border-0 @error('email')is-invalid @else border-0 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-8 mx-auto">
                                <input id="password" type="password" class="form-control bg-light shadow-sm border-0 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-8 offset-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Recuerdamé') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-2">
                                <button type="submit" class="btn btn-primary btn-block" style="color:#fff !important;">
                                    {{ __('Login') }}
                                </button>
                            </div>

                        </div>
                        <div class="d-flex justify-content-center">
                            @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Olvidé mi contraseña?') }}
                            </a>
                        @endif

                        </div>
                        <div class="d-flex justify-content-center">
                            {{-- <button class="btn btn-primary" disabled>Entrar</button> --}}
                            <p>¿No tiene cuenta todavia? <a class = "register" href="{{ route('register') }}" >Creála desde aquí</a></p>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
    @import url("https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@500;600;700&display=swap");
        h3{
            font-family:'Raleway' !important;
            color:#14505C !important;
        }

        .btn, .register{
            color:#14505C !important;
        }

</style>
@endsection
