<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/', function () {
    return "GOORITA API";
});
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);
Route::group(['middleware' => ['auth:sanctum']], function () {
    
});
