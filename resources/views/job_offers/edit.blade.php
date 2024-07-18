@extends('layouts.app')

@section('content')
<link href="{{ asset('css/edit_oferta.css') }}" rel="stylesheet">
<div class="linkedin-container">
    <div class="linkedin-card">
        <h1 class="form-title">Editar Oferta de Trabajo</h1>
        <form action="{{ route('job-offers.update', $jobOffer) }}" method="POST" class="linkedin-form">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Título</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $jobOffer->title }}" required>
            </div>
            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea class="form-control" id="description" name="description" rows="4" required>{{ $jobOffer->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="requirements">Requisitos</label>
                <textarea class="form-control" id="requirements" name="requirements" rows="4" required>{{ $jobOffer->requirements }}</textarea>
            </div>
            <div class="form-actions">
                <button type="submit" class="linkedin-btn btn-primary">Actualizar Oferta</button>
            </div>
        </form>
    </div>
</div>
@endsection
