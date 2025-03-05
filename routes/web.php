<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/criancas/create', [CriancaController::class,'create']);
Route::get('/criancas', [CriancaController::class,'store']);
Route::get('/criancas/create', [CriancaController::class, 'create'])->name('criancas.create'); 
Route::post('/criancas', [CriancaController::class, 'store'])->name('criancas.store'); 

Route::get('/criancas/rotina', [CriancaController::class,'rotina']);
Route::resource('criancas', CriancaController::class);

Route::get('/contact', function () {
    return view('contact');
});
use App\Http\Controllers\RotinaController;

Route::resource('rotinas', RotinaController::class);
Route::get('/rotinas/{id}', [RotinaController::class, 'show'])->name('rotinas.show');
use App\Http\Controllers\PresencaController;

Route::prefix('presencas')->group(function () {
    Route::get('/', [PresencaController::class, 'index'])->name('presencas.index');
    Route::get('/create', [PresencaController::class, 'create'])->name('presencas.create');
    Route::post('/', [PresencaController::class, 'store'])->name('presencas.store');
    Route::get('/{id}', [PresencaController::class, 'show'])->name('presencas.show');
});


Route::post('/presencas/{id}/registar-saida', [PresencaController::class, 'registar_saida'])->name('presencas.registar_saida');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');