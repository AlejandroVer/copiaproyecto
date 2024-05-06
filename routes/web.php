<?php

use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\SedeController;
use App\Http\Controllers\VisitaController;
use App\Models\SedeEmpresa;
use Illuminate\Support\Facades\Route;

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
});

Route::resource('empresa', EmpresaController::class)->names('empresa');


Route::resource('users', UserController::class)->names('users');

Route::resource('agendas', AgendaController::class)->names('agendas');

Route::resource('reportes', VisitaController::class)->names('reportes');

Route::resource('sedes', SedeController::class)->names('sedes');

Route::get('/obtener-datos-sede/{id}', function ($id) {
    $sede = SedeEmpresa::find($id);
    return response()->json($sede);
});









