@extends('layouts.admin')

@section('title', 'Dashboard')

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
    <h3>Crear Promocion</h3>
    <div class="content">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('tours.store') }}" method="POST" enctype='multipart/form-data'>
                    @csrf
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="form-label">Nombre</label>
                            <input id="name" name="name" type="text" value="{{ old('name') }}" class="form-control">
                            @error('name')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="form-label">Nombre amigable</label>
                            <input id="slug" name="slug" type="text" value="{{ old('slug') }}" class="form-control"
                                readonly>
                            @error('slug')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Tours</label>
                            <div class="pb-2">
                                <span class="btn btn-primary btn-sm select-all">Seleccionar Todo</span>
                                <span class="btn btn-primary btn-sm deselect-all">Deseleccionar</span>
                            </div>
                            <select class="form-control select2 {{ $errors->has('stations') ? 'is-invalid' : '' }}"
                                name="tours[]" id="txtTours" multiple>
                                @foreach ($tours as $id => $tour)
                                    <option value="{{ $id }}">
                                        {{ $tour->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('tours'))
                                <div class="invalid-feedback d-block">
                                    {{ $errors->first('tours') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="form-label">Precio</label><br>
                            <input id="amount" name="amount" value="{{ old('amount') }}" type="number"
                                class="form-control">
                            @error('amount')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="start">Fecha de Inicio</label>

                        <input type="date" id="start" name="date-start">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="finish">Fecha de Fin</label>

                        <input type="date" id="start" name="date_finish">
                    </div>

                    <div class="form-group">
                        <label for="formFile" class="form-label">Seleccionar imagen</label>
                        <input type="file" name="image" id="image" accept="image/*">
                        @error('image')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    {{-- 'name', 'description', 'tour_id', 'price', 'discount', 'date_start', 'date_finish', 'status' --}}
                    <div class="form-group">
                        <label class="form-label">Descuento</label><br>
                        <input id="discount" name="discount" value="{{ old('discount') }}" type="number"
                            class="form-control">
                        @error('discount')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-froup">
                        <div class="mb-3">
                            <label for="" class="form-label">Descripción</label><br>
                            <textarea name="description" rows="6"
                                class="form-control">{{ old('description') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Estado</label><br>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-secondary active">
                                <input type="radio" name="options" id="option1" checked> No disponible
                            </label>
                            <label class="btn btn-secondary">
                                <input type="radio" name="options" id="option2"> Disponible
                            </label>
                        </div>
                    </div>

                    <a href="/promotions" class="btn btn-secondary" tabindex="5">Cancelar</a>
                    <button type="submit" class="btn btn-primary" tabindex="4">Guardar</button>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    </div>

                </form>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="{{ asset('js/app.js') }}"></script>
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
