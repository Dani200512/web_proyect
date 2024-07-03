@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Publicaciones</h1>
    @auth
        <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Crear nueva publicación</a>
    @endauth

    @foreach($posts as $post)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $post->publication_type }}</h5>
                <p class="card-text">{{ Str::limit($post->description, 100) }}</p>
                <p>Publicado por: 
                    <a href="{{ route('user.posts', $post->profile->user) }}">
                        {{ $post->profile->user->name }}
                    </a>
                </p>
                <a href="{{ route('posts.show', $post) }}" class="btn btn-info">Ver más</a>
            </div>
        </div>
    @endforeach

    {{ $posts->links() }}
</div>
@endsection