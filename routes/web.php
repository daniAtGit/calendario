<?php

use App\Http\Controllers\EventiController;
use App\Http\Controllers\FullCalendarController;
use App\Http\Controllers\PersoneController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    //return view('welcome');
    return view('calendario');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('events', [FullCalendarController::class, 'events']);

Route::get('/nuovo-evento', [FullCalendarController::class, 'create'])->name('evento.nuovo');
Route::post('/nuovo-evento-store', [FullCalendarController::class, 'store'])->name('evento.store');
Route::get('/modifica-evento/{id}', [FullCalendarController::class, 'edit'])->name('evento.modifica');
Route::post('/modifica-evento-update/{id}', [FullCalendarController::class, 'update'])->name('evento.update');
Route::post('/modifica-evento-delete/{id}', [FullCalendarController::class, 'destroy'])->name('evento.delete');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('persone', PersoneController::class)->except('show')->parameters(['persone'=>'persona']);

    Route::resource('eventi', EventiController::class)->except('show')->parameters(['eventi'=>'evento']);

});

require __DIR__.'/auth.php';
