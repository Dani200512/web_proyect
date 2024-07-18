@extends('layouts.app')

@section('content')
<link href="{{ asset('css/edit_comentario.css') }}" rel="stylesheet">
<div class="linkedin-container">
    <div class="linkedin-card">
        <h2 class="form-title">Editar Comentario</h2>
        <form action="{{ route('comments.update', $comment) }}" method="POST" class="linkedin-form">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="content">Contenido del comentario</label>
                <textarea name="content" id="content" class="form-control" rows="3">{{ $comment->content }}</textarea>
            </div>
            <div class="form-actions">
                <button type="submit" class="linkedin-btn btn-primary">Actualizar Comentario</button>
            </div>
        </form>
    </div>
</div>
@endsection
