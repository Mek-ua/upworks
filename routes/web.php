<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

// Serve app.blade.php for the Vue frontend
Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');
