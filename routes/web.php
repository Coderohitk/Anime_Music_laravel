<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\CharactersController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MusicController;

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

Route::get('/login', function () {
    return view('login');
});
Route::get('/register', function () {
    return view('register');
});
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::post('/register', [LoginController::class, 'register']);

Route::get('/', [AnimeController::class, 'home']);
Route::post('/home', [AnimeController::class, 'home']);
Route::get('/home', [AnimeController::class, 'home']);
Route::get('/anime', [AnimeController::class, 'index']);
Route::get('/music', [MusicController::class, 'index']);
Route::get('/characters', [CharactersController::class, 'index']);
Route::get('/anime/save', [AnimeController::class, 'save']);
Route::get('/music/save', [MusicController::class, 'save']);
Route::get('/characters/save', [CharactersController::class, 'save']);
Route::get('/anime/delete/{id}', [AnimeController::class, 'delete']);
Route::get('/music/delete/{id}', [MusicController::class, 'delete']);
Route::get('/characters/delete/{id}', [CharactersController::class, 'delete']);
Route::post('/anime/save', [AnimeController::class, 'save']);
Route::post('/music/save', [MusicController::class, 'save']);
Route::post('/characters/save', [CharactersController::class, 'save']);
Route::post('/anime/update/{id}', [AnimeController::class, 'update']);
Route::post('/music/update/{id}', [MusicController::class, 'update']);
Route::post('/characters/update/{id}', [CharactersController::class, 'update']);
Route::get('/anime/update/{id}', [AnimeController::class, 'update']);
Route::get('/music/update/{id}', [MusicController::class, 'update']);
Route::get('/characters/update/{id}', [CharactersController::class, 'update']);
// Route::post('/login', 'LoginController@login');
// Route::post('/register', 'LoginController@register');
// Route::post('/anime', 'AnimeController@index');
// Route::post('/music', 'MusicController@index');
// Route::post('/characters', 'CharactersController@index');
