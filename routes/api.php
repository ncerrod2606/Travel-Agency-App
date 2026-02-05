<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');*/

Route::apiResource('vacacion', ApiController::class)->names('apivacacion');
Route::get('guzzle/{id?}', [ApiController::class, 'guzzle'])->name('apivacacion.guzzle');