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
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource ('admin','App\Http\Controllers\AdminController')->middleware('auth');

Route::resource ('dependencia','App\Http\Controllers\DependenciaController')->middleware('auth');

Route::resource ('subdependencia','App\Http\Controllers\SubdependenciaController')->middleware('auth');
Route::get('/subdependencia/{id}/index','App\Http\Controllers\SubdependenciaController@index')->name('auth');

Route::resource ('subdepe','App\Http\Controllers\SubdepeController')->middleware('auth');
Route::get('/subdepe/{id}/index','App\Http\Controllers\SubdepeController@index')->name('auth');

Route::post('/archivo/{id_dependencia}/guardar', 'App\Http\Controllers\ArchivoController@store')->name('guardararchivo');
Route::get('/archivo/{id}/index','App\Http\Controllers\ArchivoController@index')->name('auth');

Route::get('/carpeta/{id}/destroy', 'App\Http\Controllers\CarpetaController@destroy')->name('auth');

Route::post('/carpeta/{id_dependencia}/guardar', 'App\Http\Controllers\CarpetaController@store')->name('guardarcarpeta');

Route::get('/change-password', 'App\Http\Controllers\AdminController@changePassword')->name('change-password');
Route::post('/change-password', 'App\Http\Controllers\AdminController@updatePassword')->name('update-password');


require __DIR__.'/auth.php';
