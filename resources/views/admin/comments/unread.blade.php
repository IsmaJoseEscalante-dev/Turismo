@extends('layouts.admin')

@section('title', 'Comments')

@section('content')
    <div class="container my-3">
        <div class="card">
            <div class="card-body">
                <h3>Comentarios no leidos</h3>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @forelse($comments as $comment)
                    <div class="card">
                        <div class="card-body">
                            <h5 class="lead"><b>Nombre: </b>{{ $comment->name }}</h5>
                            <h5 class="lead"><b>Email: </b>{{ $comment->email }}</h5>
                            <h5 class="lead"><b>Tour: </b>{{ $comment->tour->name }}</h5>
                            <p class="lead"><b>Comentario: </b>{{ $comment->body }}</p>

                            <div>
                                <form action="{{ route('comments.ignore', $comment->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-info float-right">Ignorar</button>
                                </form>
                                <form action="{{ route('comments.publish', $comment->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-primary float-right">Publicar</button>
                                </form>
                                <form action="{{route('comments.destroy',$comment->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger float-right">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div>
                        <h5>No hay comentarios nuevos</h5>
                    </div>
                @endforelse
                <div class="float-right pt-3">
                    {{ $comments->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script src="{{ asset('js/app.js') }}"></script>
@endsection
