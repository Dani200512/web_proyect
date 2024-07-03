@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Publicaciones de {{ $profile->user->name }}</h1>
    @foreach ($posts as $post)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $post->publication_type }}</h5>
                <p class="card-text">{{ $post->description }}</p>
                <a href="{{ route('posts.show', $post) }}" class="card-link">Ver más</a>
            </div>
        </div>
    @endforeach
    {{ $posts->links() }}
</div>
@endsection