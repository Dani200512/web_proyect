@extends('layouts.app')

@section('content')
<link href="{{ asset('css/edit_posts.css') }}" rel="stylesheet">
<div class="linkedin-container">
    <div class="linkedin-card">
        <h1 class="form-title">Editar publicación</h1>
        <form action="{{ route('posts.update', $post) }}" method="POST" class="linkedin-form">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="publication_type">Tipo de publicación</label>
                <input type="text" class="form-control" id="publication_type" name="publication_type" value="{{ $post->publication_type }}" required>
            </div>
            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea class="form-control" id="description" name="description" required>{{ $post->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="content">Contenido adicional</label>
                <textarea class="form-control" id="content" name="content">{{ $post->content }}</textarea>
            </div>
            <div class="form-actions">
                <button type="submit" class="linkedin-btn btn-primary">Actualizar</button>
                <a href="{{ route('posts.index') }}" class="linkedin-btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
