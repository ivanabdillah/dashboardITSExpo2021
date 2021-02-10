<?php

use App\Http\Controllers\BeasiswaFairController;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/beasiswa-fair',[BeasiswaFairController::class,'registerPage'])->name('beasiswa-fair.index');
Route::post('/beasiswa-fair',[BeasiswaFairController::class,'register'])->name('beasiswa-fair.post');