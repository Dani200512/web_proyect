@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Contenido Multimedia</h1>
    <form action="{{ route('multimedia.update', $multimedia->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="post_id">ID del Post</label>
            <input type="number" class="form-control" id="post_id" name="post_id" value="{{ $multimedia->post_id }}" required>
        </div>
        <div class="form-group">
            <label for="photo">Foto</label>
            @if($multimedia->photo)
                <img src="{{ asset('storage/' . $multimedia->photo) }}" alt="Foto actual" class="img-thumbnail mb-2" style="max-width: 200px;">
            @endif
            <input type="file" class="form-control-file" id="photo" name="photo">
        </div>
        <div class="form-group">
            <label for="video">Video</label>
            @if($multimedia->video)
                <video controls class="mb-2" style="max-width: 200px;">
                    <source src="{{ asset('storage/' . $multimedia->video) }}" type="video/mp4">
                    Tu navegador no soporta el tag de video.
                </video>
            @endif
            <input type="file" class="form-control-file" id="video" name="video">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
