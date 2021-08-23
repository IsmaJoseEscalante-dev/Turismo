@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <h3>CREAR EXCURSIONES</h3>
    <div class="content">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('tours.store') }}" method="POST" enctype = 'multipart/form-data'>
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Nombre</label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" class="form-control">
                        @error('name')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Nombre amigable</label>
                        <input id="slug" name="slug" type="text" value="{{ old('slug') }}" class="form-control" readonly>
                        @error('slug')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                    <label for="" class="form-label">Seleccionar categoria</label>
                    <select class = 'form-control' name="category_id" value ='category_id' id = 'inputCategoryid'>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}"
                                >{{$category->name}}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Seleccionar imagen</label>
                        <input type="file" name="image" id="image" accept="image/*">
                        @error('image')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label" >Precio</label><br>
                        <input id="amount" name="amount" value="{{ old('amount') }}" type="number" class="form-control">
                        @error('amount')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Descripción</label><br>
                        <textarea class="form-control" name="description"  value="{{ old('description') }}"></textarea>
                        @error('description')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <a href="/tours" class="btn btn-secondary" tabindex="5">Cancelar</a>
                    <button type="submit" class="btn btn-primary" tabindex="4">Guardar</button>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $(document).ready(function () {
            $("#name").keyup(function () {
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

    </script>
@stop
