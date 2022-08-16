<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ScreenController;
use App\Http\Controllers\WinnerController;
use Illuminate\Support\Facades\Route;

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

Route::get('login', [LoginController::class, 'index'])->name('login.index');

// Route::middleware(['auth'])->group(function () {
    Route::resource('project', ProjectController::class);
    Route::resource('screen', ScreenController::class);
    Route::resource('item', ItemController::class);
    Route::resource('participant', ParticipantController::class);
    Route::resource('winner', WinnerController::class);
// });c
