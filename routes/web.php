<?php

use App\Http\Controllers\CreditController;
use App\Http\Controllers\CreditFormController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoasterController;

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
    return view('welcome');
});

Route::get('/dashboard', [CoasterController::class, 'showCoasters'])
    ->middleware('auth')
    ->name('dashboard');

Route::get('/coasters/{id}', [CoasterController::class, 'showCoasterDetail'])
    ->middleware('auth')
    ->name('coaster-detail');

Route::get('/credits', [CreditController::class, 'showCredits'])
    ->middleware('auth')
    ->name('credits');

Route::get('/edit-credit/{id}', [CreditFormController::class, 'showForm'])
    ->middleware('auth')
    ->name('edit-credit');

Route::post('/edit-credit/{id}', [CreditFormController::class, 'saveCredit'])
    ->middleware('auth')
    ->name('save-credit');

require __DIR__.'/auth.php';
