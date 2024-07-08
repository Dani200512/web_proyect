@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $post->publication_type }}</h1>
    <p>Por {{ $post->profile->user->name }}</p>
    <p>{{ $post->description }}</p>
    @if($post->content)
        <p>{{ $post->content }}</p>
    @endif
    @can('update', $post)
        <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary">Editar</a>
    @endcan
    @can('delete', $post)
        <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display: inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
        </form>
    @endcan
</div>
@endsection