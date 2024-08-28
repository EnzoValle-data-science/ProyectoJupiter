<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductoController;

use App\Http\Controllers\EntradaController;

use App\Http\Controllers\RecetaController;

use App\Http\Controllers\Lista_Receta_ProductoController;

use App\Http\Controllers\SalidaController;


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



Route::get('/sidebar',function(){
    return view('layouts.sidebar');
});

Route::resource('/Producto', ProductoController::class);


Route::put('/Producto/ModCantidad/{id}', [ProductoController::class, 'ModCantidad'])->name('Producto.ModCantidad');

Route::resource('/Entrada', EntradaController::class);

Route::resource('/Receta', RecetaController::class);

Route::resource('/Lista', Lista_Receta_ProductoController::class);

Route::resource('/Salida', SalidaController::class);

Auth::routes(['verify'=> true]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']); // parch



/*

GET	/Producto		Producto.index

GET	/Producto/create		Producto.create

POST	/Producto		Producto.store

GET	/Producto/{nota}		Producto.show

GET	/Producto/{nota}/edit		Producto.edit

PUT/PATCH	/Producto/{nota}		Producto.update

DELETE	/Producto/{nota}		Producto.destroy */