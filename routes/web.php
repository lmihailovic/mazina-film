<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ZanrController;
use App\Http\Controllers\ScenaController;
use App\Http\Controllers\ZaposleniController;

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
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        Route::resource('films', FilmController::class);
        Route::resource('scenas', ScenaController::class);
        Route::resource('users', UserController::class);
        Route::resource('zanrs', ZanrController::class);
        Route::resource('zaposlenis', ZaposleniController::class);
    });
