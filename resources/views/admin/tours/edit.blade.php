@extends('layouts.admin')

@section('title', 'Editar excursion')

@section('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container {
            width: 100% !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #a846ea;
        }

        .fc-unthemed td.fc-today {
            background-color: #e8d77a !important;
        }

    </style>
@endsection

@section('content')
    <h3>MODIFICAR EXCURSION</h3>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('tours.update', $tour) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="" class="form-label">Nombre</label>
                        <input id="name" name="name" type="text" class="form-control"
                            value="{{ old('name', $tour->name) }}">
                        @error('name')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="" class="form-label">Nombre amigable</label>
                        <input id="slug" name="slug" type="text" class="form-control" readonly
                            value="{{ old('slug', $tour->slug) }}">
                        @error('slug')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6 ">
                        <label>Paradas</label>
                        <select class="form-control select2 {{ $errors->has('stations') ? 'is-invalid' : '' }}"
                            name="stations[]" id="txtStations" multiple>
                            @foreach ($stations as $id => $station)
                                <option value="{{ $id }}"
                                {{ (in_array($id, old('stations', [])) || $tour->stations->contains($id)) ? 'selected' : '' }}>
                                    {{ $station }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('stations'))
                            <div class="invalid-feedback d-block">
                                {{ $errors->first('stations') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="" class="form-label">Precio</label><br>
                        <input id="amount" name="amount" type="number" class="form-control"
                            value="{{ old('amount', $tour->amount) }}">
                        @error('amount')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Seleccionar imagen</label>
                        <input type="file" name="image" accept="image/*" class="form-control">
                        @error('image')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label>Seleccionar Categoria</label>
                        <select class="form-control" name="category_id">
                            @foreach ($categories as $id => $category)
                                <option value="{{ $id }}"
                                @if($id == $tour->category_id) selected='selected' @endif
                                >{{ $category }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Descripción Tour</label><br>
                    <textarea class="ckeditor form-control"
                        name="description_tour">{{ old('description_tour', $tour->description_tour) }}</textarea>
                    @error('descripcion_tour')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Descripción de Lugares</label><br>
                    <textarea class="ckeditor form-control"
                        name="description_place">{{ old('description_place', $tour->description_place) }}</textarea>
                    @error('description_place')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Servicios</label><br>
                    <textarea class="ckeditor form-control"
                        name="services">{{ old('services', $tour->services) }}</textarea>
                    @error('services')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Itinerario</label><br>
                    <textarea class="ckeditor form-control"
                        name="itinerario">{{ old('itinerario', $tour->itinerario) }}</textarea>
                    @error('itinerario')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Tips</label><br>
                    <textarea class="ckeditor form-control" name="tips">{{ old('tips', $tour->tips) }}</textarea>
                    @error('tips')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <a href="{{ route('tours.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </form>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $("#name").keyup(function() {
                let cadena = $(this).val();
                string_to_slug(cadena);
            });
        });


        function string_to_slug(str) {
            str = str.replace(/^\s+|\s+$/g, '');
            str = str.toLowerCase();

            //quita acentos, cambia la ñ por n, etc
            let from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
            let to = "aaaaeeeeiiiioooouuuunc------";

            for (let i = 0, l = from.length; i < l; i++) {
                str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
            }

            str = str.replace(/[^a-z0-9 -]/g, '') // quita caracteres invalidos
                .replace(/\s+/g, '-') // reemplaza los espacios por -
                .replace(/-+/g, '-'); // quita las plecas

            return $("#slug").val(str);
        }

        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@stop
