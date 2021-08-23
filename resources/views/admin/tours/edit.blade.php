@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <h3>MODIFICAR EXCURSION</h3>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('tours.update', $tour) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="" class="form-label">Nombre</label>
                    <input id="name" name="name" type="text" class="form-control" value="{{old('name',$tour->name)}}">
                    @error('name')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Nombre amigable</label>
                    <input id="slug" name="slug" type="text" class="form-control" readonly value="{{ old( 'slug', $tour->slug) }}">
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
                                @if ($category->id == $tour->category_id)
                                selected
                                @endif
                                >{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Seleccionar imagen</label>
                    <input type="file" name="image" id="image" value="{{ old( 'image', $tour->image->image) }}" accept="image/*">
                    @error('image')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Precio</label><br>
                    <input id="amount" name="amount" type="number" class="form-control" value="{{old('amount',$tour->amount)}}">
                    @error('amount')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Descripción</label><br>
                    <textarea class="form-control" name="description"
                              >{{ $tour->description }}</textarea>
                    @error('description')
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
