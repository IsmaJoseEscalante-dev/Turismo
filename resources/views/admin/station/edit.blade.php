@extends('adminlte::page')

@section('title', 'Dashboard')

@section('css')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection

@section('content_header')
    <h1>MODIFICAR EXCURSION</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                       aria-controls="home" aria-selected="true">Datos</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                       aria-controls="profile" aria-selected="false">Imagenes</a>
                </li>
            </ul>
            <div class="tab-content" id="app">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <form action='{{ route('station.update', $station->id) }}' method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mt-3">
                            <label for="" class="form-label">Nombre</label>
                            <input id="name" name="name" type="text" class="form-control" value="{{$station->name}}">
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Descripción</label><br>
                            <textarea class="form-control" name="description"
                                      rows="6">{{$station->description}}</textarea>
                        </div>
                        <a href="{{ route('station.index', $station->tour_id) }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </form>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <image-component station="{{$station->id}}"></image-component>
                </div>
            </div>

        </div>
    </div>
@stop


@section('js')
    <script src="{{ asset('js/app.js') }}"></script>
@stop
