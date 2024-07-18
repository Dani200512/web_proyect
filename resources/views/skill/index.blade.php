@extends('layouts.app')

@section('content')
<link href="{{ asset('css/skill/index.css') }}" rel="stylesheet">
<div class="skills-page">
    <h1 class="skills-title">Mis Skills</h1>
    
    <div class="add-skill-section">
        <h2>Agregar Nueva Skill</h2>
        <a href="{{ route('skills.create') }}" class="add-skill-btn">+</a>
    </div>
    
    <div class="skills-grid">
        @foreach($skills as $skill)
            <div class="skill-card">
                <div class="skill-icon">
                    @if($skill->icon)
                        <img src="{{ asset('storage/' . $skill->icon) }}" alt="Icono de {{ $skill->name }}">
                    @else
                        <span class="no-icon">🔧</span>
                    @endif
                </div>
                <div class="skill-content">
                    <h3 class="skill-name">{{ $skill->name }}</h3>
                    <p class="skill-description">{{ Str::limit($skill->description, 100) }}</p>
                </div>
                <div class="skill-actions">
                    <a href="{{ route('skills.show', $skill->id) }}" class="btn btn-view">Ver</a>
                    <a href="{{ route('skills.edit', $skill->id) }}" class="btn btn-edit">Editar</a>
                    <form action="{{ route('skills.destroy', $skill->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete" onclick="return confirm('¿Estás seguro de que quieres eliminar esta skill?')">Eliminar</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection