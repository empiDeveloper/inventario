<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::apiResources(['info' => 'App\Http\Controllers\InfoController']);
Route::apiResources(['bodega' => 'App\Http\Controllers\BodegaController']);
Route::apiResources(['inventario' => 'App\Http\Controllers\InventarioController']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
