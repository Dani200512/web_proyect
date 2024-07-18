@extends('layouts.app')

@section('content')
<link href="{{ asset('css/create_oferta.css') }}" rel="stylesheet">
<div class="linkedin-container">
    <div class="linkedin-card">
        <h1 class="form-title">Crear Nueva Oferta de Trabajo</h1>
        <form action="{{ route('job-offers.store') }}" method="POST" class="linkedin-form">
            @csrf
            <div class="form-group">
                <label for="title">Título del puesto</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="description">Descripción del puesto</label>
                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="requirements">Requisitos del puesto</label>
                <textarea class="form-control" id="requirements" name="requirements" rows="4" required></textarea>
            </div>
            @if(request()->has('return_to_post'))
                <input type="hidden" name="return_to_post" value="true">
            @endif
            <div class="form-actions">
                <button type="submit" class="linkedin-btn btn-primary">Publicar oferta</button>
            </div>
        </form>
    </div>
</div>
@endsection
