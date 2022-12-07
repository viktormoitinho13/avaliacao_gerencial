<?php

use App\Http\Controllers\ClassificacoesControllers;
// use App\Http\Controllers\ClassificacoesControllers;

use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\RespostasQuestoes;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->get('/', function () {
    return view('auth.login');
});

Route::get('/home', [ClassificacoesControllers::class, 'index'])
    ->middleware('auth')
    ->name('home');

Route::middleware('auth')
    ->prefix('form')
    ->group(function () {
        Route::get('/{id}', [QuestionsController::class, 'index'])
            ->whereNumber('id')
            ->name('questions.index');

        Route::post('/create/{id}', [RespostasQuestoes::class, 'store'])
            ->whereNumber('id')
            ->name('respostas.store');
    });

require __DIR__ . '/auth.php';