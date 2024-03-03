<?php

use App\Http\Controllers\OcrController;
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

Auth::routes([  'register' => false]);

Route::get('/', 'HomeController@index')->name('home');


Route::get('/dashboard', 'HomeController@resumen')->name('dashboard');

Route::get('/dashboard-actas', 'HomeController@resumenActas')->name('dashboardActas');

Route::post('/filtrar', 'HomeController@filtrar')->name('filtrar');
Route::post('/filtrar2', 'HomeController@filtrar2')->name('filtrar2');

Route::post('/guardar', 'HomeController@guardarJrv')->name('guardar');
Route::post('/guardar2', 'HomeController@guardarActa')->name('guardar2');


Route::get('/datos', 'HomeController@formulario')->name('ingreso');
Route::get('/actas', 'HomeController@formulario_acta')->name('acta');
Route::post('/actas/procesar', 'OcrController@procesarActa')->name('acta.procesar');

Route::get('/limpiar', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    echo "Cleared all caches successfully.";
  });