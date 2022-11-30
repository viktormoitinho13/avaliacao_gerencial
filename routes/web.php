<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{QuestionsController, ClassificacoesControllers};

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

        Route::post('/create/{id}', [QuestionsController::class, 'store'])
            ->whereNumber('id')
            ->name('questions.store');
    });

require __DIR__ . '/auth.php';
