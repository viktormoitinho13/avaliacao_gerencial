<?php

use App\Http\Controllers\authorizeQuestionController;
use App\Http\Controllers\ClassificacoesControllers;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\QuestionsMonthController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\RelatorioDocController;
use App\Http\Controllers\ConclusaoController;
use App\Http\Controllers\RespostasQuestoes;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RelatorioGerenteController;
use App\Http\Controllers\SupervisorObservacaoController;
use App\Http\Controllers\RelatorioMensalController;
use App\Http\Controllers\managerReportDocMonth;
use App\Http\Controllers\ReportDocMonth;
use App\Http\Controllers\ReleaseMonthlyQuestions;
use App\Http\Controllers\RespostasMonthQuestoes;
use App\Http\Controllers\PdiFormController;
use App\Http\Controllers\pdiFormAnswersController;
use App\Http\Controllers\feedbackReportController;
use App\Http\Controllers\feedbackManagerSelfPerceptionController;
use App\Http\Controllers\feedbackCheckController;
use App\Http\Controllers\feedbackSupervisorController;
use App\Http\Controllers\managerHomeController;
use App\Http\Controllers\managerFeedbackHistoryController;
use App\Http\Controllers\historyClassificacations;


Route::middleware('guest')->get('/', function () {
    return view('auth.login');
});

Route::get('/home', [ClassificacoesControllers::class, 'index'])
    ->middleware('auth')
    ->name('home');

Route::get('/homeManager', [managerHomeController::class, 'index'])
    ->middleware('auth')
    ->name('managerHomeController.index');


Route::get('/listReportMonth', [RelatorioMensalController::class, 'index'])
    ->middleware('auth')
    ->name('listReportMonth');


Route::get('/managerFeedbackHistory', [managerFeedbackHistoryController::class, 'index'])
    ->middleware('auth')
    ->name('managerFeedbackHistory.index');

Route::get('/feedbackSupervisor', [feedbackSupervisorController::class, 'index'])
    ->middleware('auth')
    ->name('feedbackSupervisor.index');


Route::get('/conclusion', [ConclusaoController::class, 'index'])
    ->middleware('auth')
    ->name('conclusion');

Route::get('/report', [RelatorioGerenteController::class, 'index'])
    ->middleware('auth')
    ->name('report');

// Definição de rota para 'ReportDocMonth' com middleware 'auth'
Route::get('/{loja}/{mes}/{ano}', [ReportDocMonth::class, 'index'])
    ->middleware('auth')
    ->where(['loja' => '[0-9]+', 'mes' => '[0-9]+', 'ano' => '[0-9]+'])
    ->name('ReportDocMonth.index');

Route::get('/releaseQuestions', [ReleaseMonthlyQuestions::class, 'index'])
    ->middleware('auth')
    ->name('ReleaseMonthlyQuestions.index');

Route::middleware('auth')
    ->prefix('reportDoc')
    ->group(function () {
        Route::get('/{id}', [RelatorioDocController::class, 'index'])
            ->whereNumber('id')
            ->name('reportDoc.index');
    });

Route::get('/feedback/{id}', [FeedbackReportController::class, 'index'])
    ->middleware('auth')
    ->name('feedbackReportController.index');

Route::middleware('auth')
    ->group(function () {
        Route::get('/{id}', [managerReportDocMonth::class, 'index'])
            ->whereNumber('id')
            ->name('managerReportDocMonth.index');
    });


Route::get('/pdiForm', [PdiFormController::class, 'index'])
    ->middleware('auth')
    ->name('PdiFormController.index');

Route::post('/check', [feedbackCheckController::class, 'store'])
    ->middleware('auth')
    ->name('checkFeedback.store');




Route::get('/classHistory/{id}/{gerente}/{loja}', [historyClassificacations::class, 'index'])
    ->middleware('auth')
    ->name('historyClassificacations.index');



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

Route::get('/authorizeQuestion', [AuthorizeQuestionController::class, 'store'])
    ->name('authorizeQuestionController')
    ->middleware('auth');

Route::post('/create', [pdiFormAnswersController::class, 'store'])
    ->name('pdiFormAnswersController.store')
    ->middleware('auth');


Route::post('/createSelf', [feedbackManagerSelfPerceptionController::class, 'store'])
    ->name('feedbackManagerSelfPerception.store');

Route::middleware('auth')
    ->prefix('form')
    ->group(function () {
        Route::get('/questions/{id}', [QuestionsController::class, 'index'])
            ->whereNumber('id')
            ->name('questions.index');
        Route::get('/questionsMonth/{id}', [QuestionsMonthController::class, 'index'])
            ->whereNumber('id')
            ->name('questionsMonth.index');
        Route::post('/create/questions/{id}', [RespostasQuestoes::class, 'store'])
            ->whereNumber('id')
            ->name('respostas.store');
        Route::post('/create/questionsMonth/{id}', [RespostasMonthQuestoes::class, 'store'])
            ->whereNumber('id')
            ->name('respostasMonth.store');
    });



require __DIR__ . '/auth.php';
