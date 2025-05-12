<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Dashboard\Http\Controllers\PlayerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/dashboard', function (Request $request) {
//     return $request->user();
// });

Route::prefix('dashboard')->group(function () {
    Route::get('player', [PlayerController::class, 'index'])->name('player.index');
    Route::get('player/create', [PlayerController::class, 'create'])->name('player.create');
    Route::post('player/store', [PlayerController::class, 'store'])->name('player.store');
    Route::get('player/{id}', [PlayerController::class, 'show'])->name('player.show');
    Route::get('player/{id}/edit', [PlayerController::class, 'edit'])->name('player.edit');
    Route::put('player/{id}', [PlayerController::class, 'update'])->name('player.update');
    Route::delete('player/{id}', [PlayerController::class, 'destroy'])->name('player.destroy');
});