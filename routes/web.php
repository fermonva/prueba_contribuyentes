<?php

use App\Http\Controllers\AccesibilidadPersonaController;
use App\Http\Controllers\ContribuyenteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RolController::class);
    Route::resource('contribuyentes', ContribuyenteController::class);
    Route::resource('accesibilidad_personas', AccesibilidadPersonaController::class);
    Route::get('/accesibilidad_personas/municipios/{departamento_id}', [AccesibilidadPersonaController::class, 'getMunicipios']);
});
