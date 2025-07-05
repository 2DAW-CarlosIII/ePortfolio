@extends('layouts.auth')

@section('title', 'Registro')

@section('content')
    <h2 style="margin-bottom: 1.5rem; text-align: center; font-size: 1.5rem; font-weight: bold;">
        Crear Cuenta
    </h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <x-input-label for="name" value="Nombre completo" />
            <x-text-input id="name" name="name" type="text" :value="old('name')" required autofocus />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <div class="form-group">
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" name="email" type="email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div class="form-group">
            <x-input-label for="password" value="Contraseña" />
            <x-text-input id="password" name="password" type="password" required />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <div class="form-group">
            <x-input-label for="password_confirmation" value="Confirmar contraseña" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" required />
            <x-input-error :messages="$errors->get('password_confirmation')" />
        </div>

        <div class="form-group">
            <x-input-label for="role" value="Tipo de usuario" />
            <select id="role" name="role" class="form-input" required>
                <option value="">Selecciona tu rol</option>
                <option value="estudiante" {{ old('role') == 'estudiante' ? 'selected' : '' }}>Estudiante</option>
                <option value="docente" {{ old('role') == 'docente' ? 'selected' : '' }}>Docente</option>
            </select>
            <x-input-error :messages="$errors->get('role')" />
        </div>

        <div class="form-footer">
            <a class="link" href="{{ route('login') }}">
                ¿Ya tienes cuenta?
            </a>

            <x-primary-button>
                Registrarse
            </x-primary-button>
        </div>
    </form>
@endsection
