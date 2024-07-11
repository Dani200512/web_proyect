@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear nueva publicación</h1>
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="publication_type">Tipo de publicación</label>
            <input type="text" class="form-control" id="publication_type" name="publication_type" required>
        </div>
        <div class="form-group">
            <label for="content">Contenido</label>
            <textarea class="form-control" id="content" name="content"></textarea>
        </div>
        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>

        @if($jobOffers->isNotEmpty())
        <div class="form-group">
            <label>Ofertas de trabajo disponibles:</label>
            @foreach($jobOffers as $jobOffer)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="job_offers[]" value="{{ $jobOffer->id }}" id="jobOffer{{ $jobOffer->id }}">
                <label class="form-check-label" for="jobOffer{{ $jobOffer->id }}">
                    {{ $jobOffer->title }}
                </label>
            </div>
            @endforeach
        </div>
        @endif

        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
    <br>
    <a href="{{ route('job-offers.create', ['return_to_post' => true]) }}" class="btn btn-secondary">Crear Oferta De trabajo</a>
    <br>
    <br>
    <a href="{{ route('multimedia.create') }}" class="btn btn-secondary">foto o video</a>
</div>
@endsection
