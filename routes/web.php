<?php

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
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\EstudioController;
use App\Http\Controllers\OrdenController;
use App\Http\Controllers\PdfController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::resource('pacientes', PacienteController::class);
    Route::resource('estudios', EstudioController::class);
    Route::resource('ordenes', OrdenController::class);

 //   Route::resource('generate-pdf', PdfController::class);
    //Route::get('generate-pdf',PdfController::class, 'generarRecibo');
    Route::get('generate-pdf/{id}', [PdfController::class, 'generarRecibo'])->name('generate-pdf');
    Route::get('generate-labels/{id}', [PdfController::class, 'generarEtiquetas'])->name('generate-labels');
    Route::get('generate-informe/{id}', [PdfController::class, 'generarInforme'])->name('generate-informe');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
