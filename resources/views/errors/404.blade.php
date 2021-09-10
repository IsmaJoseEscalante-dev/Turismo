@extends('errors.error')
@section('title', 404)
@section('error')
    <div class="scene">
        <div class="text">Error 404</div>
        <div class="text">Pagina no encontrada!</div>
        <br><br>
        <div class="sheep">
            <span class="top">
                <div class="body"></div>
                <div class="head">
                    <div class="eye one"></div>
                    <div class="eye two"></div>
                    <div class="ear one"></div>
                    <div class="ear two"></div>
                </div>
            </span>
            <div class="legs">
                <div class="leg"></div>
                <div class="leg"></div>
                <div class="leg"></div>
                <div class="leg"></div>
            </div>

        </div>
        <br><br> <br><br>
        <a href="#" style = "font-size:1.2rem;color:white;text-decoration: none;" onclick="back()"> Volver</a>
    </div>

@endsection
