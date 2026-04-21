<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PlantillaController;
use App\Http\Controllers\CompraController;

/*
|--------------------------------------------------------------------------
| RUTA PRINCIPAL (CATÁLOGO)
|--------------------------------------------------------------------------
*/
Route::get('/', [PlantillaController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| DASHBOARD (BREEZE)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| PERFIL (BREEZE)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| PLANTILLAS
|--------------------------------------------------------------------------
*/
Route::get('/plantillas', [PlantillaController::class, 'index'])->name('plantillas.index');
Route::get('/plantilla/{id}', [PlantillaController::class, 'show'])->name('plantillas.show');

/*
|--------------------------------------------------------------------------
| COMPRAS (PROTEGIDO)
|--------------------------------------------------------------------------
*/
Route::post('/comprar/{id}', [CompraController::class, 'comprar'])
    ->middleware('auth')
    ->name('comprar');

/*
|--------------------------------------------------------------------------
| BÚSQUEDA AJAX
|--------------------------------------------------------------------------
*/
Route::get('/buscar', function () {

    $query = request('q');

    $plantillas = \App\Models\Plantilla::where('nombre', 'LIKE', "%$query%")
        ->orWhere('categoria', 'LIKE', "%$query%")
        ->get();

    return response()->json($plantillas);
})->name('buscar');

/*
|--------------------------------------------------------------------------
| AUTH (BREEZE)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';