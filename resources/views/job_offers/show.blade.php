@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $jobOffer->title }}</h1>
    <p><strong>Descripción:</strong> {{ $jobOffer->description }}</p>
    <p><strong>Requisitos:</strong> {{ $jobOffer->requirements }}</p>

     @if(Auth::check() && Auth::user()->profile->id !== $jobOffer->profile_id)
        <a href="{{ route('job-offers.apply', $jobOffer) }}" class="btn btn-primary">Aplicar a esta oferta</a>
    @endif

    @if(Auth::check() && Auth::user()->profile->id === $jobOffer->profile_id)
        <a href="{{ route('job-offers.edit', $jobOffer) }}" class="btn btn-warning">Editar</a>
    @endif

    <a href="{{ route('job-offers.index') }}" class="btn btn-secondary">Volver a la lista</a>

    @if(Auth::check() && Auth::user()->profile->id === $jobOffer->profile_id)
        <h3 class="mt-4">Aplicaciones</h3>
        @forelse($jobOffer->applications as $application)
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Aplicante: {{ $application->profile->name }}</h5>
                    <p class="card-text">Mensaje: {{ $application->message }}</p>
                    <form action="{{ route('job-applications.update', $application) }}" method="POST" class="mt-2">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <select name="status" class="form-control">
                                <option value="pending" {{ $application->status === 'pending' ? 'selected' : '' }}>Pendiente</option>
                                <option value="accepted" {{ $application->status === 'accepted' ? 'selected' : '' }}>Aceptar</option>
                                <option value="rejected" {{ $application->status === 'rejected' ? 'selected' : '' }}>Rechazar</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary mt-2">Actualizar estado</button>
                    </form>
                </div>
            </div>
        @empty
            <p class="mt-3">No hay aplicaciones para esta oferta todavía.</p>
        @endforelse
    @endif
</div>
@endsection
