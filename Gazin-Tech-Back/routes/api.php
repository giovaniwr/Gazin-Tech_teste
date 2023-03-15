<?php

use App\Http\Controllers\DesenvolvedorController;
use App\Http\Controllers\NivelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('niveis')->name('niveis.')->namespace('Niveis')->group(function () {
    Route::get('/', [NivelController::class, 'index']);
    Route::get('/{id}', [NivelController::class, 'show']);
    Route::post('/', [NivelController::class, 'create']);
    Route::put('/{id}', [NivelController::class, 'update']);
    Route::delete('/{id}', [NivelController::class, 'destroy']);
});

Route::prefix('desenvolvedor')->name('desenvolvedor.')->namespace('desenvolvedor')->group(function () {
    Route::get('desenvolvedores', [DesenvolvedorController::class, 'index']);
    Route::get('desenvolvedores/{id}', [DesenvolvedorController::class, 'show']);
    Route::post('desenvolvedores', [DesenvolvedorController::class, 'create']);
    Route::put('desenvolvedores/{id}', [DesenvolvedorController::class, 'update']);
    Route::delete('desenvolvedores/{id}', [DesenvolvedorController::class, 'destroy']);
});





