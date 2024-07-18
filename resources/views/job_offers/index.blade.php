@extends('layouts.app')

@section('content')
<link href="{{ asset('css/index_oferta.css') }}" rel="stylesheet">
<div class="linkedin-container">
    <h1 class="page-title">Mis Ofertas de Trabajo</h1>
    <a href="{{ route('job-offers.create') }}" class="linkedin-btn btn-primary mb-3">Crear Nueva Oferta</a>

    @foreach ($jobOffers as $jobOffer)
        <div class="linkedin-card job-offer-card">
            <h2 class="job-offer-title">{{ $jobOffer->title }}</h2>
            <p class="job-offer-description">{{ Str::limit($jobOffer->description, 100) }}</p>
            <div class="job-offer-actions">
                <a href="{{ route('job-offers.show', $jobOffer) }}" class="linkedin-btn btn-info">Ver Detalles</a>
                <a href="{{ route('job-offers.edit', $jobOffer) }}" class="linkedin-btn btn-warning">Editar</a>
                <form action="{{ route('job-offers.destroy', $jobOffer) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="linkedin-btn btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                </form>
            </div>
        </div>
    @endforeach

    <div class="pagination-container">
        {{ $jobOffers->links() }}
    </div>
</div>
@endsection
