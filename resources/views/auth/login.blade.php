<!-- resources/views/auth/login.blade.php -->

@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <div class="auth-container">
        <h2>Login</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
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
                <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember">Remember Me</label>
            </div>
            <button type="submit" class="button">Login</button>
        </form>
    </div>
@endsection
