@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crear nueva Skill</h2>
    <form action="{{ route('skills.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <div class="form-group">
            <label for="icon">Icono</label>
            <input type="file" class="form-control-file" id="icon" name="icon" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection