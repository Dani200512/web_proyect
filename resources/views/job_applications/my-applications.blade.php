@extends('layouts.app')

@section('content')
<link href="{{ asset('css/me_aplication.css') }}" rel="stylesheet">
<div class="my-applications-page">
    <div class="container">
        <h1 class="page-title">Mis aplicaciones</h1>
        <div class="applications-list">
            @foreach($applications as $application)
                <div class="application-card">
                    <div class="card-header">
                        <h5 class="application-title">{{ $application->jobOffer->title }}</h5>
                    </div>
                    <div class="card-body">
                        <p class="application-status">
                            Estado:
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
    </div>
</div>
@endsection