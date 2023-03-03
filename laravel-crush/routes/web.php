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

// Routes pour l'envoi de messages
Route::get('/messages/create', 'MessageController@create')->name('messages.create');
Route::post('/messages', 'MessageController@store')->name('messages.store');

// Route pour afficher le message secret
Route::get('/message/{token}', 'MessageController@show')->name('messages.show');


