<?php

use App\Http\Controllers\URLController;
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


Route::get('/', [UrlController::class, 'index'])->name('index');
Route::post('shorten', [UrlController::class, 'shorten'])->name('url.shorten');
Route::get('{hashValue}', [URLController::class, 'redirect'])->name('url.redirect');