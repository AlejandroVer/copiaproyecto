<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Jetstream\Jetstream;

class AuthenticatedSessionController extends \Laravel\Fortify\Http\Controllers\AuthenticatedSessionController
{
    protected function authenticated(Request $request, $user)
    {
        if ($user->hasRole('Gerente')) {
            return redirect()->route('reportes.index');
        } elseif ($user->hasRole('Admin Sistemas')) {
            return redirect()->route('users.index');
        } elseif ($user->hasRole('Jefe de Area')) {
            return redirect()->route('empresas.index');
        } elseif ($user->hasRole('Coor. Area')) {
            return redirect()->route('empresas.index');
        } elseif ($user->hasRole('Asesor')) {
            return redirect()->route('agendas.index');
        }

        return redirect()->route('agendas.index');
    }

    public function store(Request $request)
    {
        // Lógica de autenticación estándar de Fortify
        $this->validateLogin($request);

        if (method_exists($this, 'ensureIsNotRateLimited')) {
            $this->ensureIsNotRateLimited($request);
        }

        if (method_exists($this, 'attemptLogin')) {
            if (! $this->attemptLogin($request)) {
                return $this->sendFailedLoginResponse($request);
            }
        }

        return $this->sendLoginResponse($request);
    }
}
