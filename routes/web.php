<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BCCController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Rute untuk Admin
Route::prefix('/admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'home'])->name('admin.dashboard');
});

// Rute untuk Peserta
Route::prefix('/pengguna')->middleware(['auth', 'peserta'])->group(function () {
    Route::get('/password', [UserController::class, 'passwordForm'])->name('pengguna.password.form');
    Route::put('/password', [UserController::class, 'passwordUpdate'])->name('pengguna.password.update');
    Route::get('/biodata', [UserController::class, 'biodataForm'])->name('pengguna.biodata.form');
    Route::put('/biodata', [UserController::class, 'biodataUpdate'])->name('pengguna.biodata.update');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Beasiswa Fair
Route::get('/beasiswa-fair', [BeasiswaFairController::class, 'registerPage'])->name('beasiswa-fair.index');
Route::post('/beasiswa-fair', [BeasiswaFairController::class, 'register'])->name('beasiswa-fair.post');

//BCC
Route::get('/business-case-competition', [BCCController::class, 'registerPage'])->name('bcc.index');
Route::post('/business-case-competition', [BCCController::class, 'register'])->name('bcc.post');
