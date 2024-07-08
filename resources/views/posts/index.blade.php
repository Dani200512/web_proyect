@extends('layouts.app')

@section('content')
@if($posts->count() > 0)
    @foreach($posts as $post)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $post->publication_type }}</h5>
                <p class="card-text">{{ Str::limit($post->description, 100) }}</p>
                <a href="{{ route('posts.show', $post) }}" class="btn btn-info">Ver</a>
                <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning">Editar</a>
                <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                </form>
            </div>
        </div>
    @endforeach

    {{ $posts->links() }}
@else
    <p>No tienes publicaciones aún.</p>
@endif

@endsection
