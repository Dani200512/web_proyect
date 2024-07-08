@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Mis Skills</h2>
    <a href="{{ route('skills.create') }}" class="btn btn-primary mb-3">Agregar nueva Skill</a>
    <div class="row">
        @foreach($skills as $skill)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $skill->name }}</h5>
                        <p class="card-text">{{ Str::limit($skill->description, 100) }}</p>
                        @if($skill->icon)
                            <img src="{{ asset('storage/' . $skill->icon) }}" alt="Icono de {{ $skill->name }}" class="img-fluid mb-2" style="max-width: 50px;">
                        @else
                            <p>No hay icono disponible</p>
                        @endif
                        <div>
                            <a href="{{ route('skills.show', $skill->id) }}" class="btn btn-info btn-sm">Ver detalles</a>
                            <a href="{{ route('skills.edit', $skill->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('skills.destroy', $skill->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar esta skill?')">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection