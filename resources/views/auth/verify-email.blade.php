@extends('layouts.auth')

@section('title', 'Verificar Email')

@section('content')
    <h2 style="margin-bottom: 1rem; text-align: center; font-size: 1.5rem; font-weight: bold;">
        Verificar Email
    </h2>

    <div class="description-text">
        ¡Gracias por registrarte! Antes de comenzar, ¿podrías verificar tu dirección de email haciendo clic en el enlace que acabamos de enviarte? Si no recibiste el email, te enviaremos otro con gusto.
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success">
            Se ha enviado un nuevo enlace de verificación a la dirección de email que proporcionaste durante el registro.
        </div>
    @endif

    <div style="display: flex; justify-content: space-between; gap: 1rem; margin-top: 1.5rem;">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-primary-button>
                Reenviar Email de Verificación
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-secondary-button type="submit">
                Cerrar Sesión
            </x-secondary-button>
        </form>
    </div>
@endsection

{{-- resources/views/auth/confirm-password.blade.php --}}
@extends('layouts.auth')

@section('title', 'Confirmar Contraseña')

@section('content')
    <h2 style="margin-bottom: 1rem; text-align: center; font-size: 1.5rem; font-weight: bold;">
        Confirmar Contraseña
    </h2>

    <div class="description-text">
        Esta es un área segura de la aplicación. Por favor confirma tu contraseña antes de continuar.
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="form-group">
            <x-input-label for="password" value="Contraseña" />
            <x-text-input id="password" name="password" type="password" required autofocus />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <div style="text-align: right; margin-top: 1.5rem;">
            <x-primary-button>
                Confirmar
            </x-primary-button>
        </div>
    </form>
@endsection
