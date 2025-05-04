<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Toda rota definida nesse arquivo tem por padrão o prefixo /api
Route::apiResource('/series', \Meri\NameApp\Http\Controllers\Api\SeriesController::class);
