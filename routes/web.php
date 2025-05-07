<?php

use Illuminate\Support\Facades\Route;
use Meri\NameApp\Http\Controllers\SeriesController;

Route::resource('/series', SeriesController::class)
->except(['show']);
Route::get('/', function () {
    return redirect('/series');
});

Route::middleware(['with-auth'])->group(function () {
    Route::get('/series/{series}/edit', [\Meri\NameApp\Http\Controllers\SeasonsController::class, 'edit'])
        ->name('series.edit');

    Route::get('/series/{series}/seasons', [\Meri\NameApp\Http\Controllers\SeasonsController::class, 'index'])
        ->name('seasons.index');

    Route::get('/seasons/{season}/episodes', [\Meri\NameApp\Http\Controllers\EpisodesController::class, 'index'])
        ->name('episodes.index');
    
    Route::get('/seasons/{season}/episodes', [\Meri\NameApp\Http\Controllers\EpisodesController::class, 'index'])
        ->name('episodes.index');
    
    Route::post('/seasons/{season}/episodes', [\Meri\NameApp\Http\Controllers\EpisodesController::class, 'update']);
});

Route::get('/login', [\Meri\NameApp\Http\Controllers\LoginController::class, 'index'])
    ->name('login');
Route::post('/login', [\Meri\NameApp\Http\Controllers\LoginController::class, 'store'])
    ->name('signin');
Route::get('/logout', [\Meri\NameApp\Http\Controllers\LoginController::class, 'destroy'])
    ->name('logout');


Route::get('/register', [\Meri\NameApp\Http\Controllers\UsersController::class, 'create'])
    ->name('users.create');
Route::post('/register', [\Meri\NameApp\Http\Controllers\UsersController::class, 'store'])
    ->name('users.store');