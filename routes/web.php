<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategoriaProductosController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ContactosController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PrestadoresController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ProveedoresController;
use App\Http\Controllers\RegistroAdministradoresController;
use App\Http\Controllers\RegistroCategoriaController;
use App\Http\Controllers\RegistroCategoriaProductosController;
use App\Http\Controllers\RegistroClientesController;
use App\Http\Controllers\RegistroContactoProveedoresController;
use App\Http\Controllers\RegistroPrestadoresController;
use App\Http\Controllers\RegistroProductosController;
use App\Http\Controllers\RegistroProveedorController;
use App\Http\Controllers\RegistroServiciosController;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\TablaAdministradoresController;
use App\Http\Controllers\TablaPrestadoresController;
use Illuminate\Support\Facades\Route;



Route::post('/', HomeController::class);
Route::get('/', HomeController::class);

Route::post('dashboard', DashboardController::class)->name('dashboard');
Route::get('dashboard', DashboardController::class)->name('dashboard');

Route::post('registroprestadores', RegistroPrestadoresController::class)->name('registroprestadores');
Route::get('registroprestadores', RegistroPrestadoresController::class)->name('registroprestadores');

Route::post('registroadministradores', RegisterController::class)->name('registroadministradores');
Route::get('registroadministradores', RegisterController::class)->name('registroadministradores');

Route::post('registroclientes', RegistroClientesController::class)->name('registroclientes');
Route::get('registroclientes', RegistroClientesController::class)->name('registroclientes');

Route::post('registrocategorias', RegistroCategoriaController::class)->name('registrocategorias');
Route::get('registrocategorias', RegistroCategoriaController::class)->name('registrocategorias');

Route::post('registroservicios', RegistroServiciosController::class)->name('registroservicios');
Route::get('registroservicios', RegistroServiciosController::class)->name('registroservicios');

Route::post('registroproveedores', RegistroProveedorController::class)->name('registroproveedores');
Route::get('registroproveedores', RegistroProveedorController::class)->name('registroproveedores');

Route::post('registrocontactoproveedores', RegistroContactoProveedoresController::class)->name('registrocontactoproveedores');
Route::get('registrocontactoproveedores', RegistroContactoProveedoresController::class)->name('registrocontactoproveedores');

Route::post('registrocategoriaproductos', RegistroCategoriaProductosController::class)->name('registrocategoriaproductos');
Route::get('registrocategoriaproductos', RegistroCategoriaProductosController::class)->name('registrocategoriaproductos');

Route::post('registroproductos', RegistroProductosController::class)->name('registroproductos');
Route::get('registroproductos', RegistroProductosController::class)->name('registroproductos');

Route::post('tablaprestadores', TablaPrestadoresController::class)->name('tablaprestadores');
Route::get('tablaprestadores', TablaPrestadoresController::class)->name('tablaprestadores');

Route::post('tabladministradores', TablaAdministradoresController::class)->name('tabladministradores');
Route::get('tabladministradores', TablaAdministradoresController::class)->name('tabladministradores');






Auth::routes();
Route::post('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::apiResource('tab_categorias',CategoriasController::class);
Route::apiResource('tab_clientes',ClientesController::class);
Route::apiResource('tab_prestadores',PrestadoresController::class);
Route::apiResource('tab_servicios',ServiciosController::class);
Route::apiResource('tab_proveedores',ProveedoresController::class);
Route::apiResource('tab_contactos',ContactosController::class);
Route::apiResource('tab_categoriaproductos',CategoriaProductosController::class);
Route::apiResource('tab_productos',ProductosController::class);







