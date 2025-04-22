<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


//Route::get('/galerie', function () {
   // return view('gallery');
//});
use App\Http\Controllers\GalleryController;

Route::get('/galerie', [GalleryController::class, 'index'])->name('galerie');
