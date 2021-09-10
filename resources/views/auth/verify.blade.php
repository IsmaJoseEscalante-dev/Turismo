@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif
                    <h5 class="text-center py-3"><B>VERIFIQUE SU VANDEJA DE ENTRADA DE EMAIL</B></h5>
                    <p class="lead">Antes de continuar, verifique su correo electrónico para ver si hay un enlace de verificación.<br>
                    Si no recibió el correo electrónico,</p>
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary mt-3 align-baseline">haga clic aquí para solicitar otro</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
