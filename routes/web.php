<?php

use App\Http\Controllers\BeasiswaFairController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::prefix('/pengguna')->middleware('auth')->group(function () {
    Route::get('/password', [UserController::class, 'passwordForm'])->name('pengguna.password.form');
    Route::put('/password', [UserController::class, 'passwordUpdate'])->name('pengguna.password.update');
    Route::get('/biodata', [UserController::class, 'biodataForm'])->name('pengguna.biodata.form');
    Route::put('/biodata', [UserController::class, 'biodataUpdate'])->name('pengguna.biodata.update');
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/beasiswa-fair', [BeasiswaFairController::class, 'registerPage'])->name('beasiswa-fair.index');
Route::post('/beasiswa-fair', [BeasiswaFairController::class, 'register'])->name('beasiswa-fair.post');
