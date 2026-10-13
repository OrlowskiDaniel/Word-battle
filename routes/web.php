<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\GuessController;
use App\Http\Controllers\HistoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //About
    Route::get('/about', function () {
        return view('about.index');
    })->name('about');

    // Dashboard / lobby
    Route::get('/dashboard', [GameController::class, 'dashboard'])->name('dashboard');
 
    // ── Games ──────────────────────────────────────────────────────────
    // Show the "create game" form
    Route::get('/games/create', [GameController::class, 'create'])->name('games.create');
    // Submit the form → create game in DB and redirect to game room
    Route::post('/games', [GameController::class, 'store'])->name('games.store');
    // Show a specific game room (protected: must be a player in this game)
    Route::get('/games/{game}', [GameController::class, 'show'])
        ->name('games.show');

    Route::post('/games/{game}/join', [GameController::class, 'join'])->name('games.join');
    
    Route::post('/games/{game}/guess', [GuessController::class, 'store'])->name('games.guess');

    Route::get('/niek', );

    

    
    // History list 
    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');

    
});

require __DIR__.'/auth.php';
