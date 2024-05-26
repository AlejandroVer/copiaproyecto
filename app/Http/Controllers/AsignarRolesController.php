<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AsignarRolesController extends Controller
{
    public function asignar(Request $request)
    {
        // Encuentra el usuario y el rol por sus IDs
        $usuario = User::findOrFail(5); // Supongamos que el usuario tiene ID 5
        $rol = Role::findOrFail(1); // Supongamos que el rol tiene ID 1

        // Asigna el rol al usuario
        $usuario->assignRole($rol);

        return response()->json(['message' => 'Rol asignado correctamente al usuario.']);
    }
}
