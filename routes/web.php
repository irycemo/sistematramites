<?php

use App\Http\Livewire\Admin\Umas;
use App\Http\Livewire\Admin\Roles;
use App\Http\Livewire\Admin\Entrada;
use App\Http\Livewire\Admin\Entrega;
use App\Http\Livewire\Admin\Consulta;
use App\Http\Livewire\Admin\Notarias;
use App\Http\Livewire\Admin\Permisos;
use App\Http\Livewire\Admin\Tramites;
use App\Http\Livewire\Admin\Usuarios;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\Auditoria;
use App\Http\Livewire\Admin\Recepcion;
use App\Http\Livewire\Admin\Servicios;
use App\Http\Livewire\Admin\Dependencias;
use App\Http\Controllers\ManualController;
use App\Http\Controllers\TramitesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SetPasswordController;
use App\Http\Livewire\Admin\CategoriasServicios;
use App\Http\Livewire\Admin\Reportes;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Route::group(['middleware' => ['auth', 'esta.activo']], function(){

    Route::get('dashboard', DashboardController::class)->name('dashboard');

    Route::get('roles', Roles::class)->middleware('permission:Lista de roles')->name('roles');

    Route::get('permisos', Permisos::class)->middleware('permission:Lista de permisos')->name('permisos');

    Route::get('servicios', Servicios::class)->middleware('permission:Lista de servicios')->name('servicios');

    Route::get('categorias_servicios', CategoriasServicios::class)->middleware('permission:Lista de servicios')->name('categorias_servicios');

    Route::get('umas', Umas::class)->middleware('permission:Lista de umas')->name('umas');

    Route::get('usuarios', Usuarios::class)->middleware('permission:Lista de usuarios')->name('usuarios');

    Route::get('tramites', Tramites::class)->middleware('permission:Lista de trámites')->name('tramites');
    Route::get('tramites/recibo/{tramite}', [TramitesController::class, 'recibo'])->name('tramites.recibo');
    Route::get('tramites/orden/{tramite}', [TramitesController::class, 'orden'])->name('tramites.orden');

    Route::get('entrada', Entrada::class)->middleware('permission:Lista de entradas')->name('entrada');

    Route::get('recepcion', Recepcion::class)->middleware('permission:Recepción')->name('recepcion');

    Route::get('entrega', Entrega::class)->middleware('permission:Entrega')->name('entrega');

    Route::get('auditoria', Auditoria::class)->middleware('permission:Auditoria')->name('auditoria');

    Route::get('consulta', Consulta::class)->middleware('permission:Consultas')->name('consulta');

    Route::get('reportes', Reportes::class)->middleware('permission:Reportes')->name('reportes');

    Route::get('dependencias', Dependencias::class)->middleware('permission:Lista de dependencias')->name('dependencias');

    Route::get('notarias', Notarias::class)->middleware('permission:Lista de notarias')->name('notarias');

});

Route::get('setpassword/{email}', [SetPasswordController::class, 'create'])->name('setpassword');
Route::post('setpassword', [SetPasswordController::class, 'store'])->name('setpassword.store');

Route::get('manual', ManualController::class)->name('manual');

/* Route::get('test/{linea}', [LineaCaptura::class, 'validarLineaDeCaptura'])->name('manual'); */
