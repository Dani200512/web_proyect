@extends('layouts.app')

@section('content')
<link href="{{ asset('css/post_index.css') }}" rel="stylesheet">
<div class="linkedin-container">
    <div class="page-header">
        <h1>Publicaciones</h1>
        @if(Auth::check())
            <a href="{{ route('posts.create') }}" class="linkedin-btn btn-primary">Crear nueva publicación</a>
        @endif
    </div>

    @if($posts->count() > 0)
        <div class="posts-container">
            @foreach($posts as $post)
                <div class="linkedin-card post-card">
                    <div class="post-header">
                        <h2 class="post-title">{{ $post->publication_type }}</h2>
                        <p class="post-subtitle">
                            Por <a href="{{ route('profile.show', $post->profile->id) }}">{{ $post->profile->titulo }}</a>
                        </p>
                    </div>
                    <div class="post-body">
                        <p class="post-description">{{ Str::limit($post->description, 100) }}</p>
                    </div>
                    <div class="post-actions">
                        <a href="{{ route('posts.show', $post) }}" class="linkedin-btn btn-info">Ver</a>
                        @if(Auth::id() == $post->profile->user_id)
                            <a href="{{ route('posts.edit', $post) }}" class="linkedin-btn btn-warning">Editar</a>
                            <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="linkedin-btn btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <div class="pagination-container">
            {{ $posts->links() }}
        </div>
    @else
        <p class="no-posts">No hay publicaciones disponibles.</p>
    @endif
</div>
@endsection
