<?php

use App\Http\Controllers\ProfileController;
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

Route::middleware('auth')->group(function () {
    Route::get('/candidatures', [\App\Http\Controllers\CandidatureController::class, 'index'])->name('candidatures.index');
    Route::get('/candidatures/create', [\App\Http\Controllers\CandidatureController::class, 'create'])->name('candidatures.create');
    Route::post('/candidatures', [\App\Http\Controllers\CandidatureController::class, 'store'])->name('candidatures.store');
    Route::get('/candidatures/{candidature}', [\App\Http\Controllers\CandidatureController::class, 'show'])->name('candidatures.show');
    Route::get('/candidatures/{candidature}/edit', [\App\Http\Controllers\CandidatureController::class, 'edit'])->name('candidatures.edit');
    Route::put('/candidatures/{candidature}', [\App\Http\Controllers\CandidatureController::class, 'update'])->name('candidatures.update');
    Route::delete('/candidatures/{candidature}', [\App\Http\Controllers\CandidatureController::class, 'destroy'])->name('candidatures.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/candidatures/{candidature}/entretiens', [\App\Http\Controllers\EntretienController::class, 'index'])->name('candidatures.entretiens.index');
    Route::get('/candidatures/{candidature}/entretiens/create', [\App\Http\Controllers\EntretienController::class, 'create'])->name('candidatures.entretiens.create');
    Route::post('/candidatures/{candidature}/entretiens', [\App\Http\Controllers\EntretienController::class, 'store'])->name('candidatures.entretiens.store');
    Route::get('/candidatures/{candidature}/entretiens/{entretien}', [\App\Http\Controllers\EntretienController::class, 'show'])->name('candidatures.entretiens.show');
    Route::get('/candidatures/{candidature}/entretiens/{entretien}/edit', [\App\Http\Controllers\EntretienController::class, 'edit'])->name('candidatures.entretiens.edit');
    Route::put('/candidatures/{candidature}/entretiens/{entretien}', [\App\Http\Controllers\EntretienController::class, 'update'])->name('candidatures.entretiens.update');
    Route::delete('/candidatures/{candidature}/entretiens/{entretien}', [\App\Http\Controllers\EntretienController::class, 'destroy'])->name('candidatures.entretiens.destroy');
    Route::patch('/candidatures/{candidature}/entretiens/{entretien}/archiver', [\App\Http\Controllers\EntretienController::class, 'archiver'])->name('candidatures.entretiens.archiver');
    Route::patch('/candidatures/{candidature}/entretiens/{entretien}/restore', [\App\Http\Controllers\EntretienController::class, 'restore'])->name('candidatures.entretiens.restore');
    Route::delete('/candidatures/{candidature}/entretiens/{entretien}/force-delete', [\App\Http\Controllers\EntretienController::class, 'forceDelete'])->name('candidatures.entretiens.force-delete');
});

require __DIR__.'/auth.php';
