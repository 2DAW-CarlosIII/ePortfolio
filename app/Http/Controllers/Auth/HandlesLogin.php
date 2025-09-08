<?php

namespace App\Http\Controllers\Auth;

trait HandlesLogin
{
    protected function afterLogin($request)
    {

        $request->session()->regenerate();

        // Generar un token personal para el usuario autenticado
        $token = $request->user()->createToken('frontend-login')->plainTextToken;

        // Puedes guardar el token en la sesión, devolverlo en la respuesta, o mostrarlo en la vista
        // Ejemplo: guardar en sesión
        $request->session()->put('personal_access_token', $token);

        return redirect()->intended(route('home', absolute: false));
    }
}
