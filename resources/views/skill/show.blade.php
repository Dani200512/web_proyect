@extends('layouts.app')

@section('content')
<link href="{{ asset('css/skill/show.css') }}" rel="stylesheet">
<div class="skill-container">
    <div class="skill-card">
        <div class="skill-icon">
            @if($skill->icon)
                <img src="{{ asset('storage/' . $skill->icon) }}" alt="Icono de {{ $skill->name }}">
            @else
                <div class="icon-placeholder">
                    <i class="fas fa-code"></i>
                </div>
            @endif
        </div>
        <div class="skill-content">
            <h2 class="skill-title">{{ $skill->name }}</h2>
            <p class="skill-description">{{ $skill->description }}</p>
        </div>
    </div>
    <div class="skill-actions">
        <a href="{{ route('skills.edit', $skill->id) }}" class="btn btn-edit">Editar</a>
        <form action="{{ route('skills.destroy', $skill->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-delete" onclick="return confirm('¿Estás seguro de querer eliminar esta skill?')">Eliminar</button>
        </form>
        <a href="{{ route('skills.index') }}" class="btn btn-back">Volver a la lista</a>
    </div>
</div>
@endsection

