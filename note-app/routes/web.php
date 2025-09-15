<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopCONTROLLER;
use App\Http\Controllers\LoginCONTROLLER;
use App\Http\Controllers\SignUpCONTROLLER;
use App\Http\Controllers\NoteCONTROLLER;
use App\Http\Controllers\LabelController;

Route::get('/',[NoteController::class, 'index']);

Route::get('/top', [TopCONTROLLER::class, 'index'])->name("top");

Route::prefix('sign_up')->group(function() {
    Route::get('/', [SignUpController::class, 'index'])->name("sign_up");
    Route::post('/', [SignUpController::class, 'store'])->name("sign_up.store");
});

Route::prefix('login')->group(function() {
    Route::get('/', [LoginController::class, 'index'])->name("login");
    Route::post("/", [LoginController::class, 'store'])->name("login.store");
});

Route::middleware('auth')->group(function() {
    Route::prefix('note')->group(function() {
        Route::get('/', [NoteController::class, 'index'])->name("note");
    });
});

Route::resource('notes',NoteController::class)->middleware('auth');

Route::get('labels', [LabelController::class, 'index'])->name('labels.index');
Route::get('labels/create',[LabelController::class, 'create'])->name('labels.create');
Route::post('labels', [LabelController::class, 'store'])->name('labels.store');
Route::get('labels/{label}/edit', [LabelController::class, 'edit'])->name('labels.edit');
Route::put('labels/{label}', [LabelController::class, 'update'])->name('labels.update');
Route::delete('labels/{label}', [LabelController::class, 'destroy'])->name('labels.destroy');
