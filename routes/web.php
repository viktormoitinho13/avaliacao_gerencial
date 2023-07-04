<?php

use App\Http\Controllers\ClassificacoesControllers;
// use App\Http\Controllers\ClassificacoesControllers;

use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\RelatorioDocController;
use App\Http\Controllers\ConclusaoController;
use App\Http\Controllers\RespostasQuestoes;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RelatorioGerenteController;
use App\Http\Controllers\SupervisorObservacaoController;

Route::middleware('guest')->get('/', function () {
    return view('auth.login');
});

Route::get('/home', [ClassificacoesControllers::class, 'index'])
    ->middleware('auth')
    ->name('home');

Route::get('/conclusion', [ConclusaoController::class, 'index'])
    ->middleware('auth')
    ->name('conclusion');

Route::get('/report', [RelatorioGerenteController::class, 'index'])
    ->middleware('auth')
    ->name('report');

Route::middleware('auth')
    ->prefix('reportDoc')
    ->group(function () {
        Route::get('/{id}', [RelatorioDocController::class, 'index'])
            ->whereNumber('id')
            ->name('reportDoc.index');
    });


Route::middleware('auth')
    ->prefix('reportDocCorporate')
    ->group(function () {
        Route::get('/{id}', [RelatorioController::class, 'index'])
            ->whereNumber('id')
            ->name('reportDocCorporate.index');
               Route::post('/create/{id}', [SupervisorObservacaoController::class, 'store'])
            ->whereNumber('id')
            ->name('observacao.store');
    });



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
