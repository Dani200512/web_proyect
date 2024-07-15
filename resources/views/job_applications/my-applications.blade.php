@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mis aplicaciones</h1>
    @foreach($applications as $application)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $application->jobOffer->title }}</h5>
                <p class="card-text">Estado:
                    @if($application->status == 'pending')
                        <span class="badge bg-warning">Pendiente</span>
                    @elseif($application->status == 'accepted')
                        <span class="badge bg-success">Aceptada</span>
                    @elseif($application->status == 'rejected')
                        <span class="badge bg-danger">Rechazada</span>
                    @endif
                </p>
                <a href="{{ route('job-offers.show', $application->jobOffer) }}" class="btn btn-primary">Ver oferta</a>
            </div>
        </div>
    @endforeach
</div>
@endsection
