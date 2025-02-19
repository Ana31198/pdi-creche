<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CriancaController;
Route::get('/',[CriancaController::class,'index']);
Route::get('/criancas/create',[CriancaController::class,'create']);
Route::get('/contact', function () {  
    return view('contact'); 
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
