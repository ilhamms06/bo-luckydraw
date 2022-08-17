<?php

use App\Http\Controllers\API\ProjectController;
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
Route::post('akses-project', [ProjectController::class, 'access_project']);
Route::post('akses-screen-by-code', [ProjectController::class, 'access_screen_by_code_project']);
Route::post('item-by-screen-id', [ProjectController::class, 'getItemByScreen']);
Route::post('get-participant-by-item', [ProjectController::class, 'getParticipantByItemID']);
Route::group(['middleware' => ['auth:sanctum']], function () {
});