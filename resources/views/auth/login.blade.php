@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="login-page">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    <div class="login-container">
        <div class="login-form-container">
            <h1 class="login-title">Iniciar sesión</h1>
            <p class="login-subtitle">Mantente al día de tu mundo para buscar empleo</p>
            <form method="POST" action="{{ route('login') }}" class="login-form">
                @csrf
                <div class="form-group">
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Correo electrónico">
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
                <div class="form-group remember-me">
                    <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">Recordarme</label>
                </div>
                <button type="submit" class="login-button">Iniciar sesión</button>
            </form>
            <div class="login-divider">
                <span>o</span>
            </div>

        </div>
        <p class="signup-link">¿Eres nuevo en nuestra plataforma? <a href="{{ route('register') }}">Únete ahora</a></p>
    </div>
</div>
@endsection
