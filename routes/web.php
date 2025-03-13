<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\CriancaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RotinaController;
use App\Http\Controllers\PresencaController;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard'); // Redireciona usuários logados
    }
    return view('welcome'); // Página padrão para visitantes
});

Route::get('/contact', function () {
    return view('contact'); // Certifique-se de que a view 'contact.blade.php' existe
});

Route::middleware('auth')->group(function () {
    Route::get('/criancas', [CriancaController::class, 'index'])->name('criancas.index');
    Route::get('/criancas/create', [CriancaController::class, 'create'])->name('criancas.create'); 
    Route::post('/criancas', [CriancaController::class, 'store'])->name('criancas.store'); 
    Route::get('/criancas/{id}', [CriancaController::class, 'show'])->name('criancas.show');

    Route::get('/rotinas', [RotinaController::class ,'index'])->name('rotinas.index');
    Route::get('/rotinas/create', [RotinaController::class, 'create'])->name('rotinas.create'); 
    Route::post('/rotinas', [RotinaController::class, 'store'])->name('rotinas.store'); 
    Route::get('/rotinas/{id}', [RotinaController::class, 'show'])->name('rotinas.show');

    Route::prefix('presencas')->group(function () {
        Route::get('/', [PresencaController::class, 'index'])->name('presencas.index');
        Route::get('/create', [PresencaController::class, 'create'])->name('presencas.create');
        Route::post('/', [PresencaController::class, 'store'])->name('presencas.store');
        Route::get('/{id}', [PresencaController::class, 'show'])->name('presencas.show');
    });

    Route::post('/presencas/{id}/registar-saida', [PresencaController::class, 'registar_saida'])->name('presencas.registar_saida');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/criancas/{crianca_id}/historico', [RotinaController::class, 'historico'])->name('criancas.historico');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';