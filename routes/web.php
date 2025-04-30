<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\CriancaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RotinaController;
use App\Http\Controllers\PresencaController;

use App\Http\Controllers\FotosController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\MensagemController;
use App\Http\Controllers\UtilizadorController;
use App\Models\User;
use App\Models\Chat;
use App\Models\Mensagem;



Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard'); // Redireciona usuários logados
    }
    return view('welcome'); // Página padrão para visitantes
});
Route::get('/contact', function () {
    return view('contact');
});





Route::middleware(['auth'])->group(function () {
    
    // Ver lista de chats
    Route::get('/chats', [ChatController::class, 'index'])->name('chat.index');
    
    // Ver chat específico
    Route::get('/chats/{chat}', [ChatController::class, 'show'])->name('chats.show');
     // Enviar mensagem

    
     Route::post('/chats/{chatId}/show', [MensagemController::class, 'sendMessage'])->name('chat.send');
     Route::post('/chats/{chat}/messages', [MensagemController::class, 'store'])->name('chats.messages.store');
    });

Route::middleware('auth')->group(function () {
   
    Route::get('/presencas/horario', [PresencaController::class, 'showHorario'])->name('presencas.horario');
    Route::post('/presencas/horario', [PresencaController::class, 'salvarHorario'])->name('presencas.horario');
    
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


    Route::get('/fotos', [FotosController::class, 'index'])->name('fotos.index');
    Route::get('/fotos/create', [FotosController::class, 'create'])->name('fotos.create');
    Route::post('/fotos', [FotosController::class, 'store'])->name('fotos.store');
    Route::get('/fotos/{id}', [FotosController::class, 'show'])->name('fotos.show');
    Route::get('/fotos/{id}/edit', [FotosController::class, 'edit'])->name('fotos.edit');
    Route::put('/fotos/{id}', [FotosController::class, 'update'])->name('fotos.update');
    Route::delete('/fotos/{id}', [FotosController::class, 'destroy'])->name('fotos.destroy');

    
    Route::post('/presencas/{id}/registar-saida', [PresencaController::class, 'registar_saida'])->name('presencas.registar_saida');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/criancas/{crianca_id}/historico', [RotinaController::class, 'historico'])->name('criancas.historico');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


});

require __DIR__.'/auth.php';