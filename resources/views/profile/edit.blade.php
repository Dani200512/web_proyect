@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Perfil</h1>

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="titulo">Nombre</label>
            <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo" value="{{ old('titulo', $profile->titulo) }}" required>
            @error('titulo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" rows="3">{{ old('descripcion', $profile->descripcion) }}</textarea>
            @error('descripcion')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="foto_perfil">Foto de Perfil</label>
            <input type="file" class="form-control-file @error('foto_perfil') is-invalid @enderror" id="foto_perfil" name="foto_perfil">
            @error('foto_perfil')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            @if($profile->foto_perfil)
                <img src="{{ Storage::url($profile->foto_perfil) }}" alt="Foto de perfil actual" class="img-thumbnail mt-2" style="max-width: 200px;">
            @endif
        </div>

        <div class="form-group">
            <label for="Archivo_hvida">Hoja de Vida</label>
            <input type="file" class="form-control-file @error('Archivo_hvida') is-invalid @enderror" id="Archivo_hvida" name="Archivo_hvida">
            @error('Archivo_hvida')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            @if($profile->Archivo_hvida)
                <p class="mt-2">Archivo actual: <a href="{{ Storage::url($profile->Archivo_hvida) }}" target="_blank">Ver hoja de vida</a></p>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Perfil</button>
    </form>
</div>
@endsection
