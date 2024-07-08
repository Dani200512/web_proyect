@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Oferta de Trabajo</h1>
    <form action="{{ route('job-offers.update', $jobOffer) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $jobOffer->title }}" required>
        </div>
        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ $jobOffer->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="requirements">Requisitos</label>
            <textarea class="form-control" id="requirements" name="requirements" rows="3" required>{{ $jobOffer->requirements }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Oferta</button>
    </form>
</div>
@endsection
