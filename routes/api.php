<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FilmController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ZanrController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ScenaController;
use App\Http\Controllers\Api\ZanrFilmsController;
use App\Http\Controllers\Api\ZaposleniController;
use App\Http\Controllers\Api\FilmScenasController;
use App\Http\Controllers\Api\ScenaZaposlenisController;
use App\Http\Controllers\Api\ZaposleniScenasController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('films', FilmController::class);

        // Film Scenas
        Route::get('/films/{film}/scenas', [
            FilmScenasController::class,
            'index',
        ])->name('films.scenas.index');
        Route::post('/films/{film}/scenas', [
            FilmScenasController::class,
            'store',
        ])->name('films.scenas.store');

        Route::apiResource('scenas', ScenaController::class);

        // Scena Zaposlenis
        Route::get('/scenas/{scena}/zaposlenis', [
            ScenaZaposlenisController::class,
            'index',
        ])->name('scenas.zaposlenis.index');
        Route::post('/scenas/{scena}/zaposlenis/{zaposleni}', [
            ScenaZaposlenisController::class,
            'store',
        ])->name('scenas.zaposlenis.store');
        Route::delete('/scenas/{scena}/zaposlenis/{zaposleni}', [
            ScenaZaposlenisController::class,
            'destroy',
        ])->name('scenas.zaposlenis.destroy');

        Route::apiResource('users', UserController::class);

        Route::apiResource('zanrs', ZanrController::class);

        // Zanr Films
        Route::get('/zanrs/{zanr}/films', [
            ZanrFilmsController::class,
            'index',
        ])->name('zanrs.films.index');
        Route::post('/zanrs/{zanr}/films', [
            ZanrFilmsController::class,
            'store',
        ])->name('zanrs.films.store');

        Route::apiResource('zaposlenis', ZaposleniController::class);

        // Zaposleni Scenas
        Route::get('/zaposlenis/{zaposleni}/scenas', [
            ZaposleniScenasController::class,
            'index',
        ])->name('zaposlenis.scenas.index');
        Route::post('/zaposlenis/{zaposleni}/scenas/{scena}', [
            ZaposleniScenasController::class,
            'store',
        ])->name('zaposlenis.scenas.store');
        Route::delete('/zaposlenis/{zaposleni}/scenas/{scena}', [
            ZaposleniScenasController::class,
            'destroy',
        ])->name('zaposlenis.scenas.destroy');
    });
