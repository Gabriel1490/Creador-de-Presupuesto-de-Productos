<?php

use App\Http\Controllers\PresupuestoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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
    return view('auth.login');
});

Route::resource('pdf',App\Http\Controllers\PdfpresupuestoController::class);

// Route::get('pdf', [\App\Http\Controllers\PdfController::class, 'show']);
Route::post('/presupuesto-test', [\App\Http\Controllers\PdfController::class, 'recibePost']);

Auth::routes();

Route::resource('productos',App\Http\Controllers\ProductoController::class)->middleware('auth')->middleware('auth');
Route::resource('categorias',App\Http\Controllers\CategoriaController::class)->middleware('auth')->middleware('auth');
Route::resource('presupuestos',App\Http\Controllers\PresupuestoController::class)->middleware('auth')->middleware('auth');

// Route::post('/productos/presupuesto',[App\Http\Controllers\ProductoController::class,'presupusto']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware'=>'auth'],function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});


//Route::post('/clientes', [\App\Http\Controllers\ClientesController::class, 'store']);*/