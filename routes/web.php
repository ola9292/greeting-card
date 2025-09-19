<?php

use App\Http\Controllers\CardController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;



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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return Inertia::render('Home');
});

Route::get('/card/create', [CardController::class, 'create'])->name('card.create');
Route::post('/card/create', [CardController::class, 'store'])->name('card.store');
Route::get('/card/{slug}', [CardController::class, 'show'])->name('card.show');
