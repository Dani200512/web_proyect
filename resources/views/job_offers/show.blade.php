@extends('layouts.app')

@section('content')
<link href="{{ asset('css/show_oferta.css') }}" rel="stylesheet">
<div class="linkedin-container">
    <div class="linkedin-card job-offer-details">
        <h1 class="job-title">{{ $jobOffer->title }}</h1>
        <div class="job-info">
            <div class="info-item">
                <h2>Descripción</h2>
                <p>{{ $jobOffer->description }}</p>
            </div>
            <div class="info-item">
                <h2>Requisitos</h2>
                <p>{{ $jobOffer->requirements }}</p>
            </div>
        </div>

        <div class="action-buttons">
            @if(Auth::check() && Auth::user()->profile->id !== $jobOffer->profile_id)
                <a href="{{ route('job-offers.apply', $jobOffer) }}" class="linkedin-btn btn-primary">Aplicar a esta oferta</a>
            @endif

            @if(Auth::check() && Auth::user()->profile->id === $jobOffer->profile_id)
                <a href="{{ route('job-offers.edit', $jobOffer) }}" class="linkedin-btn btn-warning">Editar oferta</a>
            @endif

            <a href="{{ route('job-offers.index') }}" class="linkedin-btn btn-secondary">Volver a la lista</a>
        </div>
    </div>

    @if(Auth::check() && Auth::user()->profile->id === $jobOffer->profile_id)
        <div class="linkedin-card applications-section">
            <h2 class="section-title">Aplicaciones</h2>
            @forelse($jobOffer->applications as $application)
                <div class="application-card">
                    <div class="applicant-info">
                        <h3>Aplicante: {{ $application->profile->name }}</h3>
                        <p>{{ $application->profile->name }}</p>
                        <p>{{ $application->message }}</p>
                    </div>
                    <form action="{{ route('job-applications.update', $application) }}" method="POST" class="status-form">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <select name="status" class="form-control status-select">
                                <option value="pending" {{ $application->status === 'pending' ? 'selected' : '' }}>Pendiente</option>
                                <option value="accepted" {{ $application->status === 'accepted' ? 'selected' : '' }}>Aceptar</option>
                                <option value="rejected" {{ $application->status === 'rejected' ? 'selected' : '' }}>Rechazar</option>
                            </select>
                        </div>
                        <button type="submit" class="linkedin-btn btn-primary btn-sm">Actualizar estado</button>
                    </form>
                </div>
            @empty
                <p class="no-applications">No hay aplicaciones para esta oferta todavía.</p>
            @endforelse
        </div>
    @endif
</div>
@endsection
