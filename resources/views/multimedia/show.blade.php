@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles del Contenido Multimedia</h1>
    <div class="card">
        @if($multimedia->photo)
            <img src="{{ asset('storage/' . $multimedia->photo) }}" class="card-img-top" alt="Foto">
        @endif
        @if($multimedia->video)
            <div class="card-body">
                <video controls class="w-100">
                    <source src="{{ asset('storage/' . $multimedia->video) }}" type="video/mp4">
                    Tu navegador no soporta el tag de video.
                </video>
            </div>
        @endif
        <div class="card-body">
            <h5 class="card-title">Post ID: {{ $multimedia->post_id }}</h5>
            <p>Creado: {{ $multimedia->created_at }}</p>
            <p>Actualizado: {{ $multimedia->updated_at }}</p>
            <a href="{{ route('multimedia.edit', $multimedia->id) }}" class="btn btn-warning">Editar</a>
            <form action="{{ route('multimedia.destroy', $multimedia->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
            </form>
        </div>
    </div>
</div>
@endsection
