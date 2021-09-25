<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegistroAdministradoresController;
use App\Http\Controllers\RegistroCategoriaController;
use App\Http\Controllers\RegistroClientesController;
use App\Http\Controllers\RegistroPrestadoresController;
use App\Http\Controllers\RegistroServiciosController;
use App\Http\Controllers\TablaAdministradoresController;
use App\Http\Controllers\TablaPrestadoresController;
use Illuminate\Support\Facades\Route;



Route::post('/', HomeController::class);
Route::get('/', HomeController::class);

Route::post('dashboard', DashboardController::class)->name('dashboard');
Route::get('dashboard', DashboardController::class)->name('dashboard');

Route::post('registroprestadores', RegistroPrestadoresController::class)->name('registroprestadores');
Route::get('registroprestadores', RegistroPrestadoresController::class)->name('registroprestadores');

Route::post('registroadministradores', RegistroAdministradoresController::class)->name('registroadministradores');
Route::get('registroadministradores', RegistroAdministradoresController::class)->name('registroadministradores');

Route::post('registroclientes', RegistroClientesController::class)->name('registroclientes');
Route::get('registroclientes', RegistroClientesController::class)->name('registroclientes');

Route::post('registrocategorias', RegistroCategoriaController::class)->name('registrocategorias');
Route::get('registrocategorias', RegistroCategoriaController::class)->name('registrocategorias');

Route::post('registroservicios', RegistroServiciosController::class)->name('registroservicios');
Route::get('registroservicios', RegistroServiciosController::class)->name('registroservicios');

Route::post('tablaprestadores', TablaPrestadoresController::class)->name('tablaprestadores');
Route::get('tablaprestadores', TablaPrestadoresController::class)->name('tablaprestadores');

Route::post('tabladministradores', TablaAdministradoresController::class)->name('tabladministradores');
Route::get('tabladministradores', TablaAdministradoresController::class)->name('tabladministradores');




Auth::routes();
Route::post('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::apiResource('categorias','CategoriasController');



