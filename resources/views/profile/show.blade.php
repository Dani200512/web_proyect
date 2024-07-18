@extends('layouts.app')

@section('content')
<link href="{{ asset('css/profile.css') }}" rel="stylesheet">
<script src="{{ asset('js/profile.js') }}"></script>

<div class="profile-container">
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    
    <div class="profile-header">
        <div class="profile-avatar" id="profile-avatar">
            @if($profile->foto_perfil)
            <img src="{{ Storage::url($profile->foto_perfil) }}" alt="Foto de perfil">
            @else
            <img src="{{ asset('images/default-profile.png') }}" alt="Foto de perfil por defecto">
            @endif
        </div>
        
        <div class="profile-info">
            <div class="profile-details">
                <h1>{{ $profile->titulo ?? 'Sin título' }}</h1>
                <p class="profile-description">{{ $profile->descripcion ?? 'Sin descripción' }}</p>
            </div>
            <div class="profile-actions">
                @if($profile->Archivo_hvida)
                <a href="{{ Storage::url($profile->Archivo_hvida) }}" target="_blank" class="btn btn-primary">Ver Hoja de Vida</a>
                @endif
                @if($isOwner)
                <a href="{{ route('skills.index') }}" class="btn btn-info">Mis Skills</a>
                <a href="{{ route('profile.edit') }}" class="btn btn-secondary">Editar Perfil</a>
                @endif
            </div>
        </div>
    </div>
    
    <div class="profile-content">
        <div class="posts-section">
            <h3>Posts</h3>
            @if($posts->count() > 0)
                @foreach($posts as $post)
                <div class="post-card">
                    <h4>{{ $post->title }}</h4>
                    <p>{{ $post->content }}</p>
                    <div class="post-footer">
                        <small class="text-muted">Publicado el {{ $post->created_at->format('d/m/Y') }}</small>
                        @if($isOwner)
                        <div class="post-actions">
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-primary">Editar</a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar este post?')">Eliminar</button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            @else
                <p class="no-posts">Aún no hay posts publicados.</p>
            @endif
        </div>
    </div>
</div>

<!-- Modal para la imagen de perfil -->
<div id="imageModal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="modalImage">
</div>
@endsection



