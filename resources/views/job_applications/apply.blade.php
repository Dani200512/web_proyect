@extends('layouts.app')

@section('content')
<link href="{{ asset('css/aplication_offert.css') }}" rel="stylesheet">
<div class="job-application-page">
    <div class="container">
        <h1>Aplicar a la oferta: {{ $jobOffer->title }}</h1>
        <form action="{{ route('job-offers.apply.store', $jobOffer) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="message">Mensaje de aplicación:</label>
                <textarea name="message" id="message" rows="5" class="form-control @error('message') is-invalid @enderror" required>{{ old('message') }}</textarea>
                @error('message')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Enviar aplicación</button>
            <a href="{{ route('job-offers.show', $jobOffer) }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection