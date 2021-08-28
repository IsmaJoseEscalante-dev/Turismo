@extends('layouts.admin')

@section('title', 'Dashboard')

@section('style')

@endsection

@section('content')
    <h3>MODIFICAR PARADA</h3>
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
            <div class="tab-content">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <form action='{{ route('stations.update', $station->id) }}' method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mt-3">
                            <label for="" class="form-label">Nombre</label>
                            <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $station->name) }}">
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Descripción</label><br>
                            <textarea class="form-control" name="description"
                                      rows="6">{{ old('description', $station->description)}}</textarea>
                        </div>
                        <a href="{{ route('stations.index', $station->tour_id) }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </form>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                        <image-component station="{{$station->id}}"></image-component>

                </div>
            </div>

        </div>
    </div>
@endsection
