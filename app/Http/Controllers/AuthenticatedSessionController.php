<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Jetstream\Jetstream;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Traits\HasRoles;

class AuthenticatedSessionController extends \Laravel\Fortify\Http\Controllers\AuthenticatedSessionController
{
    public function store(Request $request)
    {

        $request->validate([
            'username' => 'required|string',
            'password' => 'required',
        ]);

        

        if (!Auth::attempt(['username' => $request->username, 'password' => $request->password], $request->filled('remember'))) {
            throw ValidationException::withMessages([
                'username' => [trans('auth.failed')],
            ]);
        }

        $request->session()->regenerate();

        // Redirigir según el rol del usuario
        $user = Auth::user();

        if ($user->hasRole('Gerente')) {
            return redirect()->route('reportes.index');
        } elseif ($user->hasRole('Admin Sistemas')) {
            return redirect()->route('users.index');
        } elseif ($user->hasRole('Jefe de Area')) {
            return redirect()->route('empresa.index');
        } elseif ($user->hasRole('Coor. Area')) {
            return redirect()->route('empresa.index');
        } elseif ($user->hasRole('Asesor')) {
            return redirect()->route('agendas.create');
        }

        return redirect()->route('agendas.index');

        // return redirect()->intended('/dashboard'); //No se donde quieras este
    }
}