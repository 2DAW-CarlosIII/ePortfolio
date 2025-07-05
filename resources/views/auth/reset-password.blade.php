@extends('layouts.auth')

@section('title', 'Restablecer Contraseña')

@section('content')
    <h2 style="margin-bottom: 1.5rem; text-align: center; font-size: 1.5rem; font-weight: bold;">
        Restablecer Contraseña
    </h2>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="form-group">
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" name="email" type="email" :value="old('email', $request->email)" required autofocus />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div class="form-group">
            <x-input-label for="password" value="Nueva contraseña" />
            <x-text-input id="password" name="password" type="password" required />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <div class="form-group">
            <x-input-label for="password_confirmation" value="Confirmar nueva contraseña" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" required />
            <x-input-error :messages="$errors->get('password_confirmation')" />
        </div>

        <x-primary-button class="btn-full">
            Restablecer Contraseña
        </x-primary-button>
    </form>
@endsection
