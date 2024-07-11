@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Nueva Oferta de Trabajo</h1>
    <form action="{{ route('job-offers.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="requirements">Requisitos</label>
            <textarea class="form-control" id="requirements" name="requirements" rows="3" required></textarea>
        </div>
        @if(request()->has('return_to_post'))
            <input type="hidden" name="return_to_post" value="true">
        @endif
        <button type="submit" class="btn btn-primary">Crear Oferta</button>
    </form>
</div>
@endsection