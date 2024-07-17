@extends('layouts.app')

@section('content')
<link href="{{ asset('css/post_show.css') }}" rel="stylesheet">
<div class="linkedin-container">
    <div class="linkedin-card post-card">
        <div class="post-header">
            <div class="post-header-info">
                <h1 class="post-title">{{ $post->publication_type }}</h1>
                <h6 class="post-subtitle">
                    <a href="{{ route('profile.show', $post->profile->id) }}">{{ $post->profile->titulo }}</a>
                    <span class="post-date">{{ $post->created_at->format('d/m/Y H:i') }}</span>
                </h6>
            </div>
        </div>
        <div class="post-body">
            <p class="post-description">{{ $post->description }}</p>
            @if($post->content)
                <div class="post-content">
                    <h5>Contenido adicional:</h5>
                    <div class="content-box">
                        {!! nl2br(e($post->content)) !!}
                    </div>
                </div>
            @endif
        </div>
        <div class="post-actions">
            <button class="linkedin-btn"><i class="far fa-comment"></i> Comentar</button>
        </div>
    </div>

    @if($post->jobOffers->isNotEmpty())
        <div class="linkedin-card job-offers-card">
            <div class="job-offers-header">
                <h2>Ofertas de trabajo asociadas</h2>
            </div>
            <ul class="job-offers-list">
                @foreach($post->jobOffers as $jobOffer)
                    <li class="job-offer-item">
                        <h3>{{ $jobOffer->title }}</h3>
                        <p>{{ $jobOffer->description }}</p>
                        <p><strong>Requisitos:</strong> {{ $jobOffer->requirements }}</p>
                        <a href="{{ route('job-offers.show', $jobOffer) }}" class="linkedin-btn btn-primary">Ver detalles</a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="linkedin-card comments-card">
        <div class="comments-header">
            <h3>Comentarios</h3>
        </div>
        <div class="comments-body">
            @forelse($post->comments as $comment)
                <div class="comment">
                    <div class="comment-content">
                        <strong>{{ $comment->profile->user->name }}</strong>
                        <p>{{ $comment->content }}</p>
                        <small class="comment-meta">{{ $comment->created_at->format('d/m/Y H:i') }}</small>
                        @if(Auth::user()->profile->id === $comment->profile_id)
                            <div class="comment-actions">
                                <a href="{{ route('comments.edit', $comment) }}" class="linkedin-btn btn-sm">Editar</a>
                                <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="linkedin-btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar este comentario?')">Eliminar</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <p>No hay comentarios aún.</p>
            @endforelse

            <form action="{{ route('comments.store', $post) }}" method="POST" class="comment-form">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <div class="form-group">
                    <textarea name="content" class="form-control" rows="3" required placeholder="Escribe tu comentario aquí..."></textarea>
                </div>
                <button type="submit" class="linkedin-btn btn-primary">Comentar</button>
            </form>
        </div>
    </div>

    <div class="post-navigation">
        <a href="{{ route('posts.index') }}" class="linkedin-btn btn-secondary">Lista  posts</a>
        <div class="post-edit-actions">
            @can('update', $post)
                <a href="{{ route('posts.edit', $post) }}" class="linkedin-btn btn-primary">Editar</a>
            @endcan
            @can('delete', $post)
                <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="linkedin-btn btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar esta publicación?')">Eliminar</button>
                </form>
            @endcan
        </div>
    </div>
</div>
@endsection
