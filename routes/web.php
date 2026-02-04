<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\VacacionController;
use App\Http\Controllers\TipoController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//logs
Route::get('logs',[\Rap2hpoutre\LaravelLogViewer\LogViewerController::class,'index']);

//main controller
Route::get('/', [MainController::class, 'main'])->name('main');
Route::get('about', [MainController::class, 'about'])->name('about');
Route::get('spa', [MainController::class, 'spa'])->name('spa');
Route::get('sql', [MainController::class, 'sql'])->name('sql');
Route::get('inyection', [MainController::class, 'inyection'])->name('inyection');
Route::get('image/{photo}', function($photo) {
    // Helper to view images if needed, or stick to storage link
})->name('image.show');


//vacacion controller
Route::resource('vacacion', VacacionController::class);
Route::get('vacacion/tipo/{tipo}', [VacacionController::class, 'tipo'])->name('vacacion.tipo');

//user controller
Route::resource('user', UserController::class);

//comentario controller
Route::post('comentario', [ComentarioController::class, 'store'])->name('comentario.store');
Route::get('comentario/{comentario}/edit', [ComentarioController::class, 'edit'])->name('comentario.edit');
Route::put('comentario/{comentario}', [ComentarioController::class, 'update'])->name('comentario.update');

//reserva controller
Route::post('reserva', [ReservaController::class, 'store'])->name('reserva.store');

Auth::routes(['verify' => true]);
Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('home/edit', [App\Http\Controllers\HomeController::class, 'edit'])->name('home.edit');
Route::put('home', [App\Http\Controllers\HomeController::class, 'update'])->name('home.update');