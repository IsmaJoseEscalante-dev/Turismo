@extends('layouts.admin')

@section('title', 'Comments')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h3>Datos del comentario</h3>
                <table class="table table-bordered">
                    <tr>
                        <td>Nombre</td>
                        <td>{{ $comment->name }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{ $comment->email }}</td>
                    </tr>
                    <tr>
                        <td>Tour</td>
                        <td>{{ $comment->tour->name }}</td>
                    </tr>
                    <tr>
                        <td>Publicado</td>
                        <td>{{ $comment->status }}</td>
                    </tr>
                    <tr>
                        <td>Comentario</td>
                        <td>{{ $comment->body }}</td>
                    </tr>
                </table>
                <div class="d-flex align-items-center justify-content-between mt-3">
                    <a href="{{ route('comments.index') }}" class="btn btn-primary">Volver</a>
                    <div class="d-flex">
                        @if($comment->status == 'no')
                            <form action="{{ route('comments.publish', $comment->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-primary">Publicar</button>
                            </form>
                        @endif
                        <form action="{{route('comments.destroy',$comment->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
