@extends('layouts.admin')

@section('title', 'Comments')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h3>Listado de comentarios</h3>
                <table id="station" class="table table-striped shadow-lg mt-4" style="width:100%">
                    <thead class="bg-primary text-white">
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Email</th>
                    <th scope="col">Publicado</th>
                    <th scope="col">Acciones</th>
                    </thead>
                    <tbody>
                    @foreach($comments as $comment)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $comment->name }}</td>
                            <td>{{ $comment->email }}</td>
                            <td>{{ $comment->status }}</td>
                            <td>
                                <a href="{{ route('comments.show', $comment->id) }}" class="btn btn-info">Ver</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="float-right pt-3">
                    {{ $comments->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
