<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::view('tournament', 'game/tournament');

//create player
Route::post('/players', [HomeController::class, 'storePlayer'])->name('player.store');

Route::get('/create-game', [GameController::class, 'create'])->name('game.create');
Route::post('/create-game', [GameController::class, 'store'])->name('game.store');
Route::get('/tournament={game}', [GameController::class, 'showTournament'])->name('tournament.show');
Route::post('/matches/{match}/update-score', [GameController::class, 'updateScore'])->name('match.updateScore');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';