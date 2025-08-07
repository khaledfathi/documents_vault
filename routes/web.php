<?php

use App\Features\Documents\Presentation\Http\Controllers\DocumentController;
use App\Http\Controllers\AboutAppController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::resource('/about-app', AboutAppController::class )->only(['index']);
Route::resource('documents', DocumentController::class);
Route::resource('categories', CategoryController::class)->except(['show']);


