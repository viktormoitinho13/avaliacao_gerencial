<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/', function () {
    return view('index');
})->middleware(['auth']);


Route::get('/form/{id}',[QuestionsController::class, 'index']
)->middleware(['auth'])->whereNumber('id')->name('form');

Route::get('/form2', function () {
    return view('form2');
});


require __DIR__.'/auth.php';
