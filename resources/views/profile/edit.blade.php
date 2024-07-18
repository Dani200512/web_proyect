@extends('layouts.app')

@section('content')
<link href="{{ asset('css/profile-edit.css') }}" rel="stylesheet">
<script src="{{ asset('js/edit-profile.js') }}"></script>
<div class="profile-edit-container">
    <div class="profile-edit-card">
        <h2 class="profile-edit-title">Editar Perfil</h2>
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
                <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" rows="4">{{ old('descripcion', $profile->descripcion) }}</textarea>
                @error('descripcion')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="foto_perfil">Foto de Perfil</label>
                <div class="profile-photo-container">
                    <div class="current-profile-photo">
                        @if($profile->foto_perfil)
                            <img src="{{ Storage::url($profile->foto_perfil) }}" alt="Foto de perfil actual" class="profile-photo">
                        @else
                            <div class="profile-photo-placeholder">
                                <i class="fas fa-user"></i>
                            </div>
                        @endif
                    </div>
                    <div class="custom-file-upload">
                        <input type="file" class="form-control-file @error('foto_perfil') is-invalid @enderror" id="foto_perfil" name="foto_perfil">
                        <label for="foto_perfil">Cambiar foto</label>
                    </div>
                </div>
                @error('foto_perfil')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="Archivo_hvida">Hoja de Vida</label>
                <div class="custom-file-upload">
                    <input type="file" class="form-control-file @error('Archivo_hvida') is-invalid @enderror" id="Archivo_hvida" name="Archivo_hvida">
                    <label for="Archivo_hvida">Seleccionar archivo</label>
                </div>
                @error('Archivo_hvida')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                @if($profile->Archivo_hvida)
                    <p class="mt-2">Archivo actual: <a href="{{ Storage::url($profile->Archivo_hvida) }}" target="_blank">Ver hoja de vida</a></p>
                @endif
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-update-profile">
                    Actualizar Perfil
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

