<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategoriaPrestadorServiciosController;
use App\Http\Controllers\CategoriaProductosController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ContactosController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FinanzasController;
use App\Http\Controllers\MapaPrestadoresController;
use App\Http\Controllers\MetodoPagosController;
use App\Http\Controllers\PrestadoresController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ProveedoresController;
use App\Http\Controllers\RegistroAdministradoresController;
use App\Http\Controllers\RegistroCategoriaController;
use App\Http\Controllers\RegistroCategoriaProductosController;
use App\Http\Controllers\RegistroClientesController;
use App\Http\Controllers\RegistroContactoProveedoresController;
use App\Http\Controllers\RegistroMetodoPagoController;
use App\Http\Controllers\RegistroPrestadoresController;
use App\Http\Controllers\RegistroProductosController;
use App\Http\Controllers\RegistroProveedorController;
use App\Http\Controllers\RegistroServiciosController;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\TablaAdministradoresController;
use App\Http\Controllers\TablaCategoriaProductosController;
use App\Http\Controllers\TablaCategoriasController;
use App\Http\Controllers\TablaClientesController;
use App\Http\Controllers\TablaContactosProveedoresController;
use App\Http\Controllers\TablaMetodosPagoController;
use App\Http\Controllers\TablaPrestadoresController;
use App\Http\Controllers\TablaProductosController;
use App\Http\Controllers\TablaProveedoresController;
use App\Http\Controllers\TablaServiciosController;
use App\Http\Controllers\TrabajosController;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::post('/', HomeController::class);
Route::get('/', HomeController::class);


Route::post('dashboard', DashboardController::class)->name('dashboard') -> middleware('auth');
Route::get('dashboard', DashboardController::class)->name('dashboard') -> middleware('auth');

Route::get('/logout', 'Auth\LoginController@logout');
Route::post('/logout', 'Auth\LoginController@logout');

Route::post('registroprestadores', RegistroPrestadoresController::class)->name('registroprestadores') -> middleware('auth');
Route::get('registroprestadores', RegistroPrestadoresController::class)->name('registroprestadores')-> middleware('auth');

Route::post('registroadministradores', RegisterController::class)->name('registroadministradores')-> middleware('auth');
Route::get('registroadministradores', RegisterController::class)->name('registroadministradores')-> middleware('auth');

Route::post('registroclientes', RegistroClientesController::class)->name('registroclientes')-> middleware('auth');
Route::get('registroclientes', RegistroClientesController::class)->name('registroclientes')-> middleware('auth');

Route::post('registrocategorias', RegistroCategoriaController::class)->name('registrocategorias')-> middleware('auth');
Route::get('registrocategorias', RegistroCategoriaController::class)->name('registrocategorias')-> middleware('auth');

Route::post('registroservicios', RegistroServiciosController::class)->name('registroservicios')-> middleware('auth');
Route::get('registroservicios', RegistroServiciosController::class)->name('registroservicios')-> middleware('auth');

Route::post('registroproveedores', RegistroProveedorController::class)->name('registroproveedores')-> middleware('auth');
Route::get('registroproveedores', RegistroProveedorController::class)->name('registroproveedores')-> middleware('auth');

Route::post('registrocontactoproveedores', RegistroContactoProveedoresController::class)->name('registrocontactoproveedores')-> middleware('auth');
Route::get('registrocontactoproveedores', RegistroContactoProveedoresController::class)->name('registrocontactoproveedores')-> middleware('auth');

Route::post('registrocategoriaproductos', RegistroCategoriaProductosController::class)->name('registrocategoriaproductos')-> middleware('auth');
Route::get('registrocategoriaproductos', RegistroCategoriaProductosController::class)->name('registrocategoriaproductos')-> middleware('auth');

Route::post('registroproductos', RegistroProductosController::class)->name('registroproductos')-> middleware('auth');
Route::get('registroproductos', RegistroProductosController::class)->name('registroproductos')-> middleware('auth');

Route::post('registrometodopago', RegistroMetodoPagoController::class)->name('registrometodopago')-> middleware('auth');
Route::get('registrometodopago', RegistroMetodoPagoController::class)->name('registrometodopago')-> middleware('auth');

Route::post('tablaprestadores', TablaPrestadoresController::class)->name('tablaprestadores')-> middleware('auth');
Route::get('tablaprestadores', TablaPrestadoresController::class)->name('tablaprestadores')-> middleware('auth');

Route::post('tabladministradores', TablaAdministradoresController::class)->name('tabladministradores')-> middleware('auth');
Route::get('tabladministradores', TablaAdministradoresController::class)->name('tabladministradores')-> middleware('auth');

Route::post('tablaservicios', TablaServiciosController::class)->name('tablaservicios')-> middleware('auth');
Route::get('tablaservicios', TablaServiciosController::class)->name('tablaservicios')-> middleware('auth');

Route::post('tablaproveedores', TablaProveedoresController::class)->name('tablaproveedores')-> middleware('auth');
Route::get('tablaproveedores', TablaProveedoresController::class)->name('tablaproveedores')-> middleware('auth');

Route::post('tablacategoriaproductos', TablaCategoriaProductosController::class)->name('tablacategoriaproductos')-> middleware('auth');
Route::get('tablacategoriaproductos', TablaCategoriaProductosController::class)->name('tablacategoriaproductos')-> middleware('auth');

Route::post('tablaproductos', TablaProductosController::class)->name('tablaproductos')-> middleware('auth');
Route::get('tablaproductos', TablaProductosController::class)->name('tablaproductos')-> middleware('auth');

Route::post('tablaclientes', TablaClientesController::class)->name('tablaclientes')-> middleware('auth');
Route::get('tablaclientes', TablaClientesController::class)->name('tablaclientes')-> middleware('auth');

Route::post('tablacategorias', TablaCategoriasController::class)->name('tablacategorias')-> middleware('auth');
Route::get('tablacategorias', TablaCategoriasController::class)->name('tablacategorias')-> middleware('auth');

Route::post('tablacontactosproveedores', TablaContactosProveedoresController::class)->name('tablacontactosproveedores')-> middleware('auth');
Route::get('tablacontactosproveedores', TablaContactosProveedoresController::class)->name('tablacontactosproveedores')-> middleware('auth');

Route::post('tablametodospago', TablaMetodosPagoController::class)->name('tablametodospago')-> middleware('auth');
Route::get('tablametodospago', TablaMetodosPagoController::class)->name('tablametodospago')-> middleware('auth');

Route::post('finanzas', FinanzasController::class)->name('finanzas')-> middleware('auth');
Route::get('finanzas', FinanzasController::class)->name('finanzas')-> middleware('auth');

Route::post('mapaprestadores', MapaPrestadoresController::class)->name('mapaprestadores')-> middleware('auth');
Route::get('mapaprestadores', MapaPrestadoresController::class)->name('mapaprestadores')-> middleware('auth');




Route::post('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home') -> middleware('auth');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home') -> middleware('auth');

Route::apiResource('tab_categorias',CategoriasController::class);
Route::apiResource('tab_clientes',ClientesController::class);
Route::apiResource('tab_prestadores',PrestadoresController::class);
Route::apiResource('tab_servicios',ServiciosController::class);
Route::apiResource('tab_proveedores',ProveedoresController::class);
Route::apiResource('tab_contactos',ContactosController::class);
Route::apiResource('tab_categoriaproductos',CategoriaProductosController::class);
Route::apiResource('tab_productos',ProductosController::class);
Route::apiResource('tab_metodopagos',MetodoPagosController::class);
Route::apiResource('tab_categoriaprestadorservicios',CategoriaPrestadorServiciosController::class);
Route::apiResource('tab_trabajos',TrabajosController::class);







