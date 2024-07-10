@extends('layouts.app')

@section('title', 'Registro')

@section('content')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
<div class="register-page">
    <div class="register-container">
        <div class="register-form-container">
            <h1 class="register-title">Únete a nuestra red profesional</h1>
            <p class="register-subtitle">Completa tu perfil para comenzar tu viaje profesional</p>
            <form method="POST" action="{{ route('register') }}" class="register-form">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus placeholder="Nombre">
                        @error('name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" id="lastname" name="lastname" value="{{ old('lastname') }}" required placeholder="Apellido">
                        @error('lastname')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <input type="date" id="birthdate" name="birthdate" value="{{ old('birthdate') }}" required>
                    @error('birthdate')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" id="location" name="location" value="{{ old('location') }}" placeholder="Ubicación">
                    @error('location')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <select id="gender" name="gender" required>
                        <option value="" disabled selected>Selecciona tu género</option>
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Masculino</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Femenino</option>
                        <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Otro</option>
                    </select>
                    @error('gender')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <select id="documenttype" name="documenttype" required>
                            <option value="" disabled selected>Tipo de Documento</option>
                            <option value="cc" {{ old('documenttype') == 'cc' ? 'selected' : '' }}>Cédula de Ciudadanía</option>
                            <option value="ce" {{ old('documenttype') == 'ce' ? 'selected' : '' }}>Cédula de Extranjería</option>
                            <option value="ti" {{ old('documenttype') == 'ti' ? 'selected' : '' }}>Tarjeta de Identidad</option>
                            <option value="passport" {{ old('documenttype') == 'passport' ? 'selected' : '' }}>Pasaporte</option>
                            <option value="other" {{ old('documenttype') == 'other' ? 'selected' : '' }}>Otro</option>
                        </select>
                        @error('documenttype')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" id="document_number" name="document_number" value="{{ old('document_number') }}" required placeholder="Número de Documento">
                        @error('document_number')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required placeholder="Teléfono">
                    @error('phone')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="Email">
                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="password" id="password" name="password" required placeholder="Contraseña">
                    @error('password')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="password" id="password-confirm" name="password_confirmation" required placeholder="Confirmar Contraseña">
                </div>
                <button type="submit" class="register-button">Registrarse</button>
            </form>
        </div>
        <p class="login-link">¿Ya tienes una cuenta? <a href="{{ route('login') }}">Inicia sesión</a></p>
    </div>
</div>
@endsection
