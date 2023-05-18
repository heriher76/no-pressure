<?php

use App\Http\Controllers\PinController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PinController::class, 'index'])->name('home');
Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {
    Route::get('/pins', [PinController::class, 'pins'])->name('pins');
    Route::post('/pins/store', [PinController::class, 'store'])->name('pin.store');
    Route::get('/pins/show', [PinController::class, 'show'])->name('pin.show');
    Route::get('/pins/edit', [PinController::class, 'edit'])->name('pin.edit');
    Route::post('/pins/update', [PinController::class, 'update'])->name('pin.update');
    Route::post('/pins/destroy', [PinController::class, 'destroy'])->name('pin.destroy');
});
