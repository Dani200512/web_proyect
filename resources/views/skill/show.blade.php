@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detalles de la Skill</h2>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $skill->name }}</h5>
            <p class="card-text">{{ $skill->description }}</p>
            @if($skill->icon)
                <img src="{{ asset('storage/' . $skill->icon) }}" alt="Icono de {{ $skill->name }}" class="img-fluid mb-3" style="max-width: 100px;">
            @else
                <p>No hay icono disponible para esta skill.</p>
            @endif
        </div>
    </div>
    <div class="mt-3">
        <a href="{{ route('skills.edit', $skill->id) }}" class="btn btn-primary">Editar</a>
        <form action="{{ route('skills.destroy', $skill->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de querer eliminar esta skill?')">Eliminar</button>
        </form>
        <a href="{{ route('skills.index') }}" class="btn btn-secondary">Volver a la lista</a>
    </div>
</div>
@endsection