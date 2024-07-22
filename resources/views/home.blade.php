@extends('layouts.app')

@section('content')
<link href="{{ asset('css/home.css') }}" rel="stylesheet">
<div class="container-fluid">
    <div class="row">
        <!-- Columna izquierda para perfil -->
        <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <h5 class="card-title mb-1">{{ Auth::user()->name }}</h5>
                    <p class="card-text text-muted mb-2">{{ Auth::user()->profile->titulo ?? 'Tu título profesional' }}</p>
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary btn-sm w-100">Editar perfil</a>
                </div> 
                <div class="card-footer">
                    <a class="nav-link" href="{{ route('my-applications') }}">Mis aplicaciones a ofertas</a>
                </div>
            </div>
        </div>

        <!-- Columna central para publicaciones -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <a href="{{ route('posts.create') }}" class="btn btn-light btn-block text-left">Crear nueva publicación</a>
                </div>
            </div>

            @if($posts->count() > 0)
                @foreach($posts as $post)
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ $post->profile->avatar ?? 'https://via.placeholder.com/50' }}" class="rounded-circle mr-3" width="50" height="50" alt="Profile Picture">
                                <div>
                                    <h6 class="mb-0"><a href="{{ route('profile.show', $post->profile->id) }}" class="text-dark font-weight-bold">{{ $post->profile->titulo }}</a></h6>
                                    <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                            <h5 class="card-title">{{ $post->publication_type }}</h5>
                            <p class="card-text">{{ $post->content }}</p>
                            <p class="card-text"><small class="text-muted">{{ $post->description }}</small></p>

                            @if($post->multimedias->isNotEmpty())
    <div class="multimedia-content mt-3">
        @foreach($post->multimedias as $multimedia)
            @if($multimedia->type === 'photo')
                <img src="{{ asset('storage/' . $multimedia->path) }}" class="img-fluid mb-2" alt="Foto de la publicación">
            @elseif($multimedia->type === 'video')
                <video width="100%" controls class="mb-2">
                    <source src="{{ asset('storage/' . $multimedia->path) }}" type="video/mp4">
                    Tu navegador no soporta el tag de video.
                </video>
            @endif
        @endforeach
    </div>
@endif

                            @if($post->jobOffers->isNotEmpty())
                            <div class="job-offers mt-3">
                                <h6>Ofertas de trabajo relacionadas:</h6>
                                <ul class="list-unstyled">
                                    @foreach($post->jobOffers as $jobOffer)
                                        <li class="mb-3 border-bottom pb-2">
                                            <strong>{{ $jobOffer->title }}</strong>
                                            <p class="mb-1 text-muted">{{ Str::limit($jobOffer->description, 100) }}</p>
                                            <a href="{{ route('job-offers.show', $jobOffer->id) }}" class="btn btn-outline-primary btn-sm">Ver detalles de la oferta</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-outline-info btn-sm mt-3">Ver más</a>
                        </div>

                        <!-- Sección de comentarios -->
                        <div class="card-footer bg-light">
                            <h6 class="mb-3">Comentarios:</h6>
                            @foreach($post->comments()->latest()->take(3)->get() as $comment)
                                <div class="comment mb-2 d-flex">

                                    <div>
                                        <strong>{{ $comment->profile->titulo }}:</strong>
                                        <span>{{ $comment->content }}</span>
                                        @if(Auth::check() && Auth::user()->profile && $comment && $comment->profile)
                                        @if(Auth::user()->profile->id === $comment->profile_id)
                                            <!-- Tu código aquí -->

                                            <div class="mt-1">
                                                <a href="{{ route('comments.edit', $comment) }}" class="btn btn-sm btn-link p-0 mr-2">Editar</a>
                                                <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-link p-0 text-danger">Eliminar</button>
                                                </form>
                                            </div>
                                        @endif
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                            <a href="{{ route('posts.show', $post) }}" class="btn btn-sm btn-link">Ver todos los comentarios</a>
                            <!-- Formulario para agregar comentario -->
                            <form action="{{ route('comments.store') }}" method="POST" class="mt-3">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <div class="form-group">
                                    <textarea name="content" class="form-control" rows="2" placeholder="Escribe un comentario..."></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">Comentar</button>
                            </form>
                        </div>
                    </div>
                @endforeach

                <div class="d-flex justify-content-center">
                    {{ $posts->links() }}
                </div>
            @else
                <div class="alert alert-info">No hay publicaciones disponibles.</div>
            @endif
        </div>
    </div>
</div>
@endsection
