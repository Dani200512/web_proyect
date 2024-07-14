@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Columna izquierda para perfil -->
        <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <img src="{{ Auth::user()->profile->avatar ?? 'https://via.placeholder.com/150' }}" class="rounded-circle img-thumbnail mb-3" alt="Profile Picture">
                    <h5 class="card-title">{{ Auth::user()->name }}</h5>
                    <p class="card-text text-muted">{{ Auth::user()->profile->titulo ?? 'Tu título profesional' }}</p>
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary btn-sm">Editar perfil</a>
                </div>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('my-applications') }}">Mis aplicaciones</a>
                </li>
            </div>
        </div>

        <!-- Columna central para publicaciones -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <a href="{{ route('posts.create') }}" class="btn btn-primary btn-block">Crear nueva publicación</a>
                </div>
            </div>

            @if($posts->count() > 0)
                @foreach($posts as $post)
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ $post->profile->avatar ?? 'https://via.placeholder.com/50' }}" class="rounded-circle mr-3" width="50" height="50" alt="Profile Picture">
                                <div>
                                    <h6 class="mb-0"><a href="{{ route('profile.show', $post->profile->id) }}" class="text-dark">{{ $post->profile->titulo }}</a></h6>
                                    <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                            <h5 class="card-title">{{ $post->publication_type }}</h5>
                            <p class="card-text">{{ Str::limit($post->description, 150) }}</p>

                            @if($post->jobOffers->isNotEmpty())
                                <h6 class="mt-3">Ofertas de trabajo asociadas:</h6>
                                <ul class="list-unstyled">
                                    @foreach($post->jobOffers as $jobOffer)
                                        <li class="mb-2">
                                            <strong>{{ $jobOffer->title }}</strong>
                                            <p class="mb-0 text-muted">{{ Str::limit($jobOffer->description, 100) }}</p>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif

                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-outline-info btn-sm mt-3">Ver más</a>
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

@push('styles')
<link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endpush
