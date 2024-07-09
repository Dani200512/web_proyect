@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">{{ $post->publication_type }}</h1>
            <h6 class="card-subtitle mb-2 text-muted">
                Por <a href="{{ route('profile.show', $post->profile->id) }}">{{ $post->profile->titulo }}</a>
            </h6>
            <p class="card-text">{{ $post->description }}</p>
            @if($post->content)
                <div class="card-text mt-4">
                    <h5>Contenido adicional:</h5>
                    {!! nl2br(e($post->content)) !!}
                </div>
            @endif
            <p class="card-text"><small class="text-muted">Publicado el {{ $post->created_at->format('d/m/Y H:i') }}</small></p>

            <div class="mt-4">
                <a href="{{ route('posts.index') }}" class="btn btn-secondary">Volver a la lista</a>
                @can('update', $post)
                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary">Editar</a>
                @endcan
                @can('delete', $post)
                    <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar esta publicación?')">Eliminar</button>
                    </form>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
