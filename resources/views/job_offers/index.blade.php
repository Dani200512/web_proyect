@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mis Ofertas de Trabajo</h1>
    <a href="{{ route('job-offers.create') }}" class="btn btn-primary mb-3">Crear Nueva Oferta</a>

    @foreach ($jobOffers as $jobOffer)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $jobOffer->title }}</h5>
                <p class="card-text">{{ Str::limit($jobOffer->description, 100) }}</p>
                <a href="{{ route('job-offers.show', $jobOffer) }}" class="btn btn-info">Ver Detalles</a>
                <a href="{{ route('job-offers.edit', $jobOffer) }}" class="btn btn-warning">Editar</a>
                <form action="{{ route('job-offers.destroy', $jobOffer) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                </form>
            </div>
        </div>
    @endforeach

    {{ $jobOffers->links() }}
</div>
@endsection
