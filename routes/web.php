<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\PlantillaController;

Route::get('/', [PlantillaController::class, 'index']);
Route::get('/plantilla/{id}', [PlantillaController::class, 'ver']);
Route::get('/crear', [PlantillaController::class, 'crear']);
Route::post('/guardar', [PlantillaController::class, 'guardar']);