@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Comentario</h2>
    <form action="{{ route('comments.update', $comment) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <textarea name="content" class="form-control" rows="3" required>{{ $comment->content }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Comentario</button>
    </form>
</div>
@endsection