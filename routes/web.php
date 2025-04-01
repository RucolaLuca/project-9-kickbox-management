<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrainingController;
use App\Http\Middleware\Training;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::name("/trainings.")->group(function(){
    Route::middleware(Training::class)->group(function () {

            Route::get('/trainings', [TrainingController::class, 'index'])->name('index');
            Route::get('/trainings/create', [TrainingController::class, 'create'])->name('create');
            Route::post('/trainings/store', [TrainingController::class, 'store'])->name('store');
            Route::get('/trainings/{id}/edit', [TrainingController::class, 'edit'])->name('edit');
            Route::put('/trainings/{id}/update', [TrainingController::class, 'update'])->name('update');
            Route::delete('/trainings/{id}/delete', [TrainingController::class, 'delete'])->name('delete');

    });
});



require __DIR__.'/auth.php';

