@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Contenido Multimedia</h1>
    <a href="{{ route('multimedia.create') }}" class="btn btn-primary mb-3">Agregar Nuevo</a>

    <div class="row">
        @foreach($multimedia as $media)
        <div class="col-md-4 mb-4">
            <div class="card">
                @if($media->photo)
                    <img src="{{ asset('storage/' . $media->photo) }}" class="card-img-top" alt="Foto">
                @endif
                @if($media->video)
                    <div class="card-body">
                        <video controls class="w-100">
                            <source src="{{ asset('storage/' . $media->video) }}" type="video/mp4">
                            Tu navegador no soporta el tag de video.
                        </video>
                    </div>
                @endif
                <div class="card-body">
                    <h5 class="card-title">Post ID: {{ $media->post_id }}</h5>
                    <a href="{{ route('multimedia.show', $media->id) }}" class="btn btn-info">Ver</a>
                    <a href="{{ route('multimedia.edit', $media->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('multimedia.destroy', $media->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
