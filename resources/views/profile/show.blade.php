@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ Auth::user()->name }}!</h1>

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

                    @if(Auth::id() == $profile->user_id)
                        <a href="{{ route('profile.edit') }}" class="btn btn-secondary">Editar Perfil</a>
                        <a href="{{ route('skills.index') }}" class="btn btn-info">Mis Skills</a>
                    @else
                        <div class="mt-3">
                            <h4>Skills</h4>
                            @forelse($profile->skills as $skill)
                                <a href="{{ route('skills.show', $skill->id) }}" class="btn btn-primary btn-sm me-2 mb-2">{{ $skill->name }}</a>
                            @empty
                                <p>Este usuario aún no ha agregado skills.</p>
                            @endforelse
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <h2>Publicaciones</h2>
    @forelse($posts as $post)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $post->publication_type }}</h5>
                <p class="card-text">{{ $post->description }}</p>
                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-sm btn-primary">Ver más</a>
                @if(Auth::id() == $profile->user_id)
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-secondary">Editar</a>
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de querer eliminar esta publicación?')">Eliminar</button>
                    </form>
                @endif
            </div>
        </div>
    @empty
        <p>Este usuario aún no tiene publicaciones.</p>
    @endforelse

    {{ $posts->links() }}
</div>
@endsection
