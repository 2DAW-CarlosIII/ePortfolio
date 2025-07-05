@extends('layouts.auth')

@section('title', 'Iniciar Sesión')

@section('content')
    <h2 style="margin-bottom: 1.5rem; text-align: center; font-size: 1.5rem; font-weight: bold;">
        Iniciar Sesión
    </h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" name="email" type="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div class="form-group">
            <x-input-label for="password" value="Contraseña" />
            <x-text-input id="password" name="password" type="password" required />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <div class="checkbox-group">
            <input id="remember_me" type="checkbox" class="checkbox" name="remember">
            <label for="remember_me" class="text-small">Recordarme</label>
        </div>

        <div class="form-footer">
            @if (Route::has('password.request'))
                <a class="link" href="{{ route('password.request') }}">
                    ¿Olvidaste tu contraseña?
                </a>
            @endif

            <x-primary-button>
                Entrar
            </x-primary-button>
        </div>

        <div class="text-center" style="margin-top: 1.5rem;">
            <span class="text-small">¿No tienes cuenta? </span>
            <a href="{{ route('register') }}" class="link">Regístrate aquí</a>
        </div>
    </form>
@endsection
