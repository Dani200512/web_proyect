<!-- resources/views/auth/register.blade.php -->

@extends('layouts.app')

@section('title', 'Registro')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <div class="auth-container">
        <h2>Registro</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="lastname">Apellido</label>
                <input type="text" id="lastname" name="lastname" value="{{ old('lastname') }}" required>
                @error('lastname')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="birthdate">Fecha de Nacimiento</label>
                <input type="date" id="birthdate" name="birthdate" value="{{ old('birthdate') }}" required>
                @error('birthdate')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="location">Ubicación</label>
                <input type="text" id="location" name="location" value="{{ old('location') }}">
                @error('location')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="gender">Género</label>
                <input type="text" id="gender" name="gender" value="{{ old('gender') }}" required>
                @error('gender')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="documenttype">Tipo de Documento</label>
                <input type="text" id="documenttype" name="documenttype" value="{{ old('documenttype') }}" required>
                @error('documenttype')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="phone">Teléfono</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required>
                @error('phone')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password-confirm">Confirmar Password</label>
                <input type="password" id="password-confirm" name="password_confirmation" required>
            </div>
            <button type="submit" class="button">Registrar</button>
        </form>
    </div>
@endsection
