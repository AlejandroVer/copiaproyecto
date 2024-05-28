<?php

use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\SedeController;
use App\Http\Controllers\VisitaController;
use App\Http\Controllers\AsignarRolesController;
use App\Models\SedeEmpresa;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');

Route::resource('empresa', EmpresaController::class)->except('show')->names('empresa');


Route::resource('users', UserController::class)->except('show')->names('users');

Route::resource('agendas', AgendaController::class)->names('agendas');

Route::resource('reportes', VisitaController::class)->names('reportes');

Route::resource('sedes', SedeController::class)->names('sedes');

Route::get('/obtener-informacion-sede', [EmpresaController::class, 'obtenerInformacionSede'])->name('obtener_informacion_sede');

Route::post('/asignar-rol', [AsignarRolesController::class, 'asignar'])->name('asignar.rol');










