@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Perfil de Usuario</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    @if($profile->foto_perfil)
                        <img src="{{ Storage::url($profile->foto_perfil) }}" alt="Foto de perfil" class="img-fluid rounded-circle mb-3">
                    @else
                        <img src="{{ asset('images/default-profile.png') }}" alt="Foto de perfil por defecto" class="img-fluid rounded-circle mb-3">
                    @endif
                </div>
                <div class="col-md-8">
                    <h2>{{ $profile->titulo }}</h2>
                    <p>{{ $profile->descripcion }}</p>

                    @if($profile->Archivo_hvida)
                        <p><a href="{{ Storage::url($profile->Archivo_hvida) }}" target="_blank" class="btn btn-primary">Ver Hoja de Vida</a></p>
                    @endif

                    <a href="{{ route('profile.edit') }}" class="btn btn-secondary">Editar Perfil</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
