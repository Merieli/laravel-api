<?php

use Illuminate\Support\Facades\Route;
use Meri\NameApp\Http\Controllers\SeriesController;

Route::get('/', function () {
    return redirect('/series');
});

Route::resource('/series', SeriesController::class)
    ->except(['show']);
