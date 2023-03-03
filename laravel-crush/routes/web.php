<?php

use Illuminate\Support\Facades\Route;

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

// Afficher le formulaire d'envoi de message
Route::get('/messages/create', [App\Http\Controllers\MessageController::class, 'create'])->name('messages.create');

// Enregistrer le message dans la base de données
Route::post('/messages', [App\Http\Controllers\MessageController::class, 'store'])->name('messages.store');

// Afficher le message secret
Route::get('/message/{token}', [App\Http\Controllers\MessageController::class, 'show'])->name('messages.show');

