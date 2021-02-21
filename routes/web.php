<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BCCController;
use App\Http\Controllers\BeasiswaFairController;
use App\Http\Controllers\BPCController;
use App\Http\Controllers\ConferenceController;
use App\Http\Controllers\PaperCompetitionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VirtualArtExhibitionController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Beasiswa Fair
Route::get('/beasiswa-fair', [BeasiswaFairController::class, 'registerPage'])->name('beasiswa-fair.index');
Route::post('/beasiswa-fair', [BeasiswaFairController::class, 'register'])->name('beasiswa-fair.post');

//BCC
Route::get('/business-case-competition', [BCCController::class, 'registerPage'])->name('bcc.index');
Route::post('/business-case-competition', [BCCController::class, 'register'])->name('bcc.post');

//BPC
Route::get('/business-plan-competition', [BPCController::class, 'registerPage'])->name('bpc.index');
Route::post('/business-plan-competition', [BPCController::class, 'register'])->name('bpc.post');

//Conference
Route::get('/conference',[ConferenceController::class,'registerPage'])->name('conference.index');
Route::post('/conference',[ConferenceController::class,'register'])->name('conference.post');

//Paper Competition
Route::get('/paper-competition',[PaperCompetitionController::class,'registerPage'])->name('paper-competition.index');
Route::post('/paper-competition',[PaperCompetitionController::class,'register'])->name('paper-competition.post');

//Virtual Art Exhibition
Route::get('/virtual-art-exhibition',[VirtualArtExhibitionController::class,'registerPage'])->name('vae.index');
Route::post('/virtual-art-exhibition',[VirtualArtExhibitionController::class,'register'])->name('vae.post');
Auth::routes();

//Route yang butuh autentikasi
Route::middleware(['auth'])->group(function () {
    
    //Untuk verifikasi email
    Route::prefix('/email')->group(function () {
        Route::get('/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
            $request->fulfill();

            return redirect('/home');
        })->middleware(['signed'])->name('verification.verify');

        Route::get('/verify', function () {
            return view('auth.verify');
        })->name('verification.notice');

        Route::post('/verification-notification', function (Request $request) {
            $request->user()->sendEmailVerificationNotification();

            return back()->with('message', 'Verification link sent!');
        })->middleware(['throttle:6,1'])->name('verification.resend');
    });

    Route::middleware(['verified'])->group(function () {
        // Rute untuk Admin
        Route::prefix('/admin')->middleware(['admin'])->group(function () {
            Route::get('/dashboard', [AdminController::class, 'home'])->name('admin.dashboard');
        });

        // Rute untuk Peserta
        Route::prefix('/pengguna')->middleware(['peserta'])->group(function () {
            Route::get('/password', [UserController::class, 'passwordForm'])->name('pengguna.password.form');
            Route::put('/password', [UserController::class, 'passwordUpdate'])->name('pengguna.password.update');
            Route::get('/biodata', [UserController::class, 'biodataForm'])->name('pengguna.biodata.form');
            Route::put('/biodata', [UserController::class, 'biodataUpdate'])->name('pengguna.biodata.update');
        });
    });
});
