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
use App\Exports\EmpresasExport;
use Maatwebsite\Excel\Facades\Excel;

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

/* Route::get('/', function () {
    return view('auth.login');
})->name('login'); */

Route::get('/', function () {
    return redirect()->route('login');
})->name('web.home.index');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');

Route::resource('empresa', EmpresaController::class)->except('show')->names('empresa');


Route::resource('users', UserController::class)->except('show')->names('users');

Route::resource('agendas', AgendaController::class)->except('show')->names('agendas');

Route::get('agendas/export', [AgendaController::class, 'export'])->name('agendas.export');

Route::resource('reportes', VisitaController::class)->except('show')->names('reportes');

Route::resource('sedes', SedeController::class)->except('show','edit','index')->names('sedes');

Route::get('/obtener-informacion-sede', [EmpresaController::class, 'obtenerInformacionSede'])->name('obtener_informacion_sede');

Route::post('/asignar-rol', [AsignarRolesController::class, 'asignar'])->name('asignar.rol');

Route::get('/exportar-empresas', [EmpresaController::class, 'exportarEmpresas'])->name('empresas.export');

Route::get('/empresas/export-create', [EmpresaController::class, 'exportEmpresasCreate'])->name('empresas.export.create');

Route::get('users/export', [UserController::class, 'exportUsers'])->name('users.export');











