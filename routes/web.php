<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('vehicule', App\Http\Controllers\VehiculeController::class);

Route::resource('maintenance', App\Http\Controllers\MaintenanceController::class);

Route::resource('entretien', App\Http\Controllers\EntretienController::class);

Route::resource('depense', App\Http\Controllers\DepenseController::class);

Route::resource('carburant', App\Http\Controllers\CarburantController::class);
