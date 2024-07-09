@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Publicaciones</h1>

    @if(Auth::check())
        <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Crear nueva publicación</a>
    @endif

    @if($posts->count() > 0)
        @foreach($posts as $post)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->publication_type }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                        Por <a href="{{ route('profile.show', $post->profile->id) }}">{{ $post->profile->titulo }}</a>
                    </h6>
                    <p class="card-text">{{ Str::limit($post->description, 100) }}</p>
                    <a href="{{ route('posts.show', $post) }}" class="btn btn-info">Ver</a>
                    @if(Auth::id() == $post->profile->user_id)
                        <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach

        {{ $posts->links() }}
    @else
        <p>No hay publicaciones disponibles.</p>
    @endif
</div>
@endsection
