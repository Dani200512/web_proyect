@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">{{ $post->publication_type }}</h1>
            <h6 class="card-subtitle mb-2 text-muted">
                Por <a href="{{ route('profile.show', $post->profile->id) }}">{{ $post->profile->titulo }}</a>
            </h6>
            <p class="card-text">{{ $post->description }}</p>
            @if($post->content)
                <div class="card-text mt-4">
                    <h5>Contenido adicional:</h5>
                    {!! nl2br(e($post->content)) !!}
                </div>
            @endif
            <p class="card-text"><small class="text-muted">Publicado el {{ $post->created_at->format('d/m/Y H:i') }}</small></p>

            @if($post->jobOffers->isNotEmpty())
                <div class="mt-4">
                    <h2>Ofertas de trabajo asociadas:</h2>
                    <ul class="list-group">
                        @foreach($post->jobOffers as $jobOffer)
                            <li class="list-group-item">
                                <h3>{{ $jobOffer->title }}</h3>
                                <p>{{ $jobOffer->description }}</p>
                                <p><strong>Requisitos:</strong> {{ $jobOffer->requirements }}</p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mt-4">
                <a href="{{ route('posts.index') }}" class="btn btn-secondary">Volver a la lista</a>
                @can('update', $post)
                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary">Editar</a>
                @endcan
                @can('delete', $post)
                    <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar esta publicación?')">Eliminar</button>
                    </form>
                @endcan
            </div>

            <!-- Comentarios -->
            <div class="comments mt-4">
                <h3>Comentarios</h3>
                @foreach($post->comments as $comment)
                    <div class="comment mb-3">
                        <p>{{ $comment->content }}</p>
                        <small>Por {{ $comment->profile->user->name }} el {{ $comment->created_at->format('d/m/Y H:i') }}</small>
                        @can('delete', $comment)
                            <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        @endcan
                    </div>
                @endforeach

                <!-- Formulario para agregar comentario -->
                <form action="{{ route('comments.store', $post) }}" method="POST" class="mt-3">
                    @csrf
                    <div class="form-group">
                        <textarea name="content" class="form-control" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Comentar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection