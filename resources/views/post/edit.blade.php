@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar publicación</h1>
    <form action="{{ route('posts.update', $post) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="publication_type">Tipo de publicación</label>
            <input type="text" class="form-control" id="publication_type" name="publication_type" value="{{ $post->publication_type }}" required>
        </div>
        <div class="form-group">
            <label for="content">Contenido</label>
            <textarea class="form-control" id="content" name="content">{{ $post->content }}</textarea>
        </div>
        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea class="form-control" id="description" name="description" required>{{ $post->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection