@extends('layouts.app')

@section('content')
<link href="{{ asset('css/skill/edit.css') }}" rel="stylesheet">
<div class="container">
    <div class="edit-skill-container">
        <h2>Editar Skill</h2>
        <form action="{{ route('skills.update', $skill->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="skill-photo-container" id="skillPhotoContainer">
                @if($skill->icon)
                    <img src="{{ asset('storage/'.$skill->icon) }}" alt="Current Icon" class="skill-photo" id="skillPhoto">
                @else
                    <div class="skill-photo-placeholder">+</div>
                    <img class="skill-photo" id="skillPhoto" style="display: none;" alt="Skill photo">
                @endif
            </div>
            <input type="file" id="skillPhotoInput" class="file-input" name="icon" accept="image/*">
            
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $skill->name }}" required>
            </div>
            
            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea class="form-control" id="description" name="description" rows="3" required>{{ $skill->description }}</textarea>
            </div>
            
            <button type="submit" class="btn btn-primary btn-block">Actualizar Skill</button>
        </form>
    </div>
</div>
@endsection