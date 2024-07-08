@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $jobOffer->title }}</h1>
    <p><strong>Descripción:</strong> {{ $jobOffer->description }}</p>
    <p><strong>Requisitos:</strong> {{ $jobOffer->requirements }}</p>
    <a href="{{ route('job-offers.edit', $jobOffer) }}" class="btn btn-warning">Editar</a>
    <a href="{{ route('job-offers.index') }}" class="btn btn-secondary">Volver a la lista</a>
</div>
@endsection
