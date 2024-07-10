@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Perfil de Usuario</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    @if($profile->foto_perfil)
                        <img src="{{ Storage::url($profile->foto_perfil) }}" alt="Foto de perfil" class="img-fluid rounded-circle mb-3">
                    @else
                        <img src="{{ asset('images/default-profile.png') }}" alt="Foto de perfil por defecto" class="img-fluid rounded-circle mb-3">
                    @endif
                </div>
                <div class="col-md-8">
                    <h2>{{ $profile->titulo ?? 'Sin título' }}</h2>
                    <p>{{ $profile->descripcion ?? 'Sin descripción' }}</p>

                    @if($profile->Archivo_hvida)
                        <p><a href="{{ Storage::url($profile->Archivo_hvida) }}" target="_blank" class="btn btn-primary">Ver Hoja de Vida</a></p>
                    @endif

                    @if($isOwner)
                        <a href="{{ route('profile.edit') }}" class="btn btn-secondary">Editar Perfil</a>
                        <a href="{{ route('skills.index') }}" class="btn btn-info">Mis Skills</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Sección de Posts -->
    <div class="card">
        <div class="card-header">
            <h3>Posts</h3>
        </div>
        <div class="card-body">
            @if($posts->count() > 0)
                @foreach($posts as $post)
                    <div class="mb-3 pb-3 border-bottom">
                        <h4>{{ $post->title }}</h4>
                        <p>{{ $post->content }}</p>
                        <small class="text-muted">Publicado el {{ $post->created_at->format('d/m/Y') }}</small>
                        @if($isOwner)
                            <div class="mt-2">
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-primary">Editar</a>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar este post?')">Eliminar</button>
                                </form>
                            </div>
                        @endif
                    </div>
                @endforeach
            @else
                <p>Aún no hay posts publicados.</p>
            @endif
        </div>
    </div>
</div>
@endsection
