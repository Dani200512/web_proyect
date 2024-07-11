@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-between mb-4">
        <div class="col-md-6">
            <p>Welcome, {{ Auth::user()->name }}!</p>
            <h1>Publicaciones recientes</h1>
        </div>
        <div class="col-md-6 text-md-end">
            <a href="{{ route('posts.create') }}" class="btn btn-primary">Crear nueva publicación</a>
        </div>
    </div>

    @if($posts->count() > 0)
        @foreach($posts as $post)
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="card-title">{{ $post->publication_type }}</h2>
                    <h6 class="card-subtitle mb-2 text-muted">
                        Por <a href="{{ route('profile.show', $post->profile->id) }}">{{ $post->profile->titulo }}</a>
                    </h6>
                    <p class="card-text">{{ Str::limit($post->description, 150) }}</p>
                    
                    @if($post->jobOffers->isNotEmpty())
                        <h3>Ofertas de trabajo asociadas:</h3>
                        <ul>
                            @foreach($post->jobOffers as $jobOffer)
                                <li>
                                    <strong>{{ $jobOffer->title }}</strong>
                                    <p>{{ Str::limit($jobOffer->description, 100) }}</p>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                    
                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-sm btn-info">Ver más</a>
                </div>
            </div>
        @endforeach

        <div class="d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    @else
        <p>No hay publicaciones disponibles.</p>
    @endif
</div>
@endsection
