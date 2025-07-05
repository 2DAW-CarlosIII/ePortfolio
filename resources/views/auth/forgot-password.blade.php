@extends('layouts.auth')

@section('title', 'Recuperar Contraseña')

@section('content')
    <h2 style="margin-bottom: 1rem; text-align: center; font-size: 1.5rem; font-weight: bold;">
        Recuperar Contraseña
    </h2>

    <div class="description-text">
        ¿Olvidaste tu contraseña? No hay problema. Solo proporciona tu dirección de email y te enviaremos un enlace para restablecer tu contraseña.
    </div>

    <x-auth-session-status :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="form-group">
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" name="email" type="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <x-primary-button class="btn-full">
            Enviar Enlace de Recuperación
        </x-primary-button>

        <div class="text-center" style="margin-top: 1.5rem;">
            <a href="{{ route('login') }}" class="link">Volver al login</a>
        </div>
    </form>
@endsection
