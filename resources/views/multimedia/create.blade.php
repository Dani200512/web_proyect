@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Agregar Nuevo Contenido Multimedia</h1>
    <form action="{{ route('multimedia.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="photo">Foto</label>
            <input type="file" class="form-control-file" id="photo" name="photo">
        </div>
        <div class="form-group">
            <label for="video">Video</label>
            <input type="file" class="form-control-file" id="video" name="video">
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection
