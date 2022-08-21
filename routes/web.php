<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ScreenController;
use App\Http\Controllers\WinnerController;
use App\Models\Pricing;
use Illuminate\Support\Facades\Auth;
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



Route::get('login', [LoginController::class, 'index'])->name('login.index');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::get('register', [RegisterController::class, 'index'])->name('register.index');
Route::post('register', [RegisterController::class, 'register'])->name('register');
Route::middleware(['auth'])->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/', function () {
        return view('welcome',[
            'pricing' => Pricing::all()
        ]);
    });
    Route::resource('project', ProjectController::class);
    Route::resource('screen', ScreenController::class);
    Route::resource('item', ItemController::class);
    Route::resource('participant', ParticipantController::class);
    Route::resource('winner', WinnerController::class);
});

Route::get('getScreen/{id}', [ParticipantController::class, 'getScreen'])->name('getScreen');
Route::get('getItem/{id}', [ParticipantController::class, 'getItem'])->name('getItem');

