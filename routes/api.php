<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');*/

Route::apiResource('peinado', ApiController::class)->names('apipeinado');
Route::get('guzzle/{id?}', [ApiController::class, 'guzzle'])->name('apipeinado.guzzle');