@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Skill</h2>
    <form action="{{ route('skills.update', $skill->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $skill->name }}" required>
        </div>
        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea class="form-control" id="description" name="description" required>{{ $skill->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="icon">Icono</label>
            <input type="file" class="form-control-file" id="icon" name="icon" accept="image/*">
            @if($skill->icon)
                <p>Icono actual: <img src="{{ asset('storage/'.$skill->icon) }}" alt="Current Icon" style="max-width: 100px;"></p>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection