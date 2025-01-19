<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ReviewsController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect()->route('book.index');
});

Route::resource('book', BookController::class)->only(['index', 'show']);

Route::resource('book.reviews', ReviewsController::class)
    ->scoped(['reviews' => 'book'])
    ->only(['create', 'store']);
