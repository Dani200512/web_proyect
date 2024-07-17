@extends('layouts.app')

@section('content')
<link href="{{ asset('css/profile_posts.css') }}" rel="stylesheet">
<div class="linkedin-container">
    <div class="profile-header">
        <h1>Publicaciones de {{ $profile->user->name }}</h1>
    </div>
    <div class="posts-container">
        @foreach ($posts as $post)
            <div class="linkedin-card post-card">
                <div class="post-header">
                    <div class="post-header-info">
                        <h2 class="post-title">{{ $post->publication_type }}</h2>
                        <p class="post-meta">{{ $post->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
                <div class="post-body">
                    <p class="post-description">{{ Str::limit($post->description, 150) }}</p>
                </div>
                <div class="post-actions">
                    <a href="{{ route('posts.show', $post) }}" class="linkedin-btn btn-primary">Ver más</a>
                </div>
            </div>
        @endforeach
    </div>
    <div class="pagination-container">
        {{ $posts->links() }}
    </div>
</div>
@endsection
