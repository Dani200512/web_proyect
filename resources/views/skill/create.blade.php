@extends('layouts.app')

@section('content')
<link href="{{ asset('css/skill/create.css') }}" rel="stylesheet">
<div class="container">
    <div class="skill-form-container">
        <h2 class="form-title">Crear nueva Skill</h2>
        <form action="{{ route('skills.store') }}" method="POST" enctype="multipart/form-data" class="skill-form">
            @csrf
            <div class="form-group">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-input" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="description" class="form-label">Descripción</label>
                <textarea class="form-input form-textarea" id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="icon" class="form-label">Icono</label>
                <div class="file-input-wrapper">
                    <input type="file" class="file-input" id="icon" name="icon" accept="image/*" required>
                    
                </div>
            </div>
            <button type="submit" class="submit-btn">Guardar</button>
        </form>
    </div>
</div>
@endsection

@push('styles')
    <link href="{{ asset('css/skill-form.css') }}" rel="stylesheet">
@endpush