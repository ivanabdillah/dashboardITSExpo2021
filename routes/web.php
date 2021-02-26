<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BCCController;
use App\Http\Controllers\BeasiswaFairController;
use App\Http\Controllers\BPCController;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\ConferenceController;
use App\Http\Controllers\PaperCompetitionController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PembayaranController;
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
    return redirect()->route('login');
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
Route::get('/conference', [ConferenceController::class, 'registerPage'])->name('conference.index');
Route::post('/conference', [ConferenceController::class, 'register'])->name('conference.post');

//Paper Competition
Route::get('/paper-competition', [PaperCompetitionController::class, 'registerPage'])->name('paper-competition.index');
Route::post('/paper-competition', [PaperCompetitionController::class, 'register'])->name('paper-competition.post');

//Virtual Art Exhibition
Route::get('/virtual-art-exhibition', [VirtualArtExhibitionController::class, 'registerPage'])->name('vae.index');
Route::post('/virtual-art-exhibition', [VirtualArtExhibitionController::class, 'register'])->name('vae.post');
Auth::routes(['register' => false]);

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

            Route::get('/password', [UserController::class, 'adminPasswordForm'])->name('admin.password.form');
            Route::put('/password', [UserController::class, 'adminPasswordUpdate'])->name('admin.password.update');

            Route::get('/dashboard', [AdminController::class, 'home'])->name('admin.dashboard');
            Route::get('/peserta/{id}', [AdminController::class, 'peserta'])->name('admin.peserta');
            Route::post('/berkas/biodata', [UserController::class, 'berkasBiodata'])->name('admin.berkas.biodata');
            Route::get('/pembayaran/{filter?}', [PembayaranController::class, 'halamanVerifikasi'])->name('admin.pembayaran');
            Route::get('/bukti-bayar/{id}', [PembayaranController::class, 'berkasBukti'])->name('admin.pembayaran.berkas-bukti');
            Route::get('/pembayaran/verifikasi/{id}', [PembayaranController::class, 'verifPembayaran'])->name('admin.pembayaran.verif');
            Route::get('/pembayaran/unverifikasi/{id}', [PembayaranController::class, 'unVerifPembayaran'])->name('admin.pembayaran.unverif');

            Route::get('/promo', [AdminController::class, 'promo'])->name('admin.promo');
            Route::post('/promo', [AdminController::class, 'tambahPromo'])->name('admin.promo.tambah');
            Route::put('/promo/{id}', [AdminController::class, 'updatePromo'])->name('admin.promo.update');
            Route::delete('/promo/{id}', [AdminController::class, 'hapusPromo'])->name('admin.promo.hapus');

            Route::get('/pengumuman', [AdminController::class, 'indexAnnouncement'])->name('admin.pengumuman');
            Route::post('/pengumuman/tambah', [AdminController::class, 'tambahAnnouncement'])->name('admin.pengumuman.tambah');
            Route::delete('/pengumuman/{id}', [AdminController::class, 'hapusAnnouncement'])->name('admin.pengumuman.hapus');

            Route::get('/instruksi', [CompetitionController::class, 'index'])->name('admin.instruksi');
            Route::get('/instruksi/baru', [CompetitionController::class, 'create'])->name('admin.instruksi.baru');
            Route::post('/instruksi', [CompetitionController::class, 'store'])->name('admin.instruksi.tambah');
            Route::delete('/instruksi/{id}', [CompetitionController::class, 'destroy'])->name('admin.instruksi.hapus');
            Route::get('/instruksi/{id}/edit', [CompetitionController::class, 'edit'])->name('admin.instruksi.edit');
            Route::put('/instruksi/{id}', [CompetitionController::class, 'update'])->name('admin.instruksi.update');
            Route::put('/instruksi/{id}/toggle', [CompetitionController::class, 'toggle'])->name('admin.instruksi.toggle');

            Route::get('/submission/{id?}', [CompetitionController::class, 'indexAdmin'])->name('admin.submission.index');
            Route::post('/submission/berkas/', [CompetitionController::class, 'berkasSubmission'])->name('admin.submission.berkas');

            Route::get('/submission/lolos/{id}/{submissionId}', [CompetitionController::class, 'loloskan'])->name('admin.submission.lolos');
            Route::get('/submission/tidak-lolos/{id}/{submissionId}', [CompetitionController::class, 'tidakLoloskan'])->name('admin.submission.tidak-lolos');
        });

        // Rute untuk Peserta
        Route::prefix('/pengguna')->middleware(['peserta'])->group(function () {
            Route::get('/pengumuman', [PesertaController::class, 'indexAnnouncement'])->name('pengguna.pengumuman');
            Route::get('/password', [UserController::class, 'passwordForm'])->name('pengguna.password.form');
            Route::put('/password', [UserController::class, 'passwordUpdate'])->name('pengguna.password.update');
            Route::get('/biodata', [UserController::class, 'biodataForm'])->name('pengguna.biodata.form');
            Route::put('/biodata', [UserController::class, 'biodataUpdate'])->name('pengguna.biodata.update');

            Route::get('/submission', [CompetitionController::class, 'indexPeserta'])->name('pengguna.submission.index');
            Route::get('/submission/diunggah', [CompetitionController::class, 'listSubmmission'])->name('pengguna.submission.list');
            Route::post('/submission', [CompetitionController::class, 'submissionAdd'])->name('pengguna.submission.store');
            Route::post('/submission/berkas/', [CompetitionController::class, 'berkasSubmission'])->name('pengguna.submission.berkas');


            Route::prefix('/pembayaran')->group(function () {
                Route::get('/', [PembayaranController::class, 'halamanPembayaran'])->name('pengguna.pembayaran');
                Route::get('/bukti-bayar/{id}', [PembayaranController::class, 'berkasBukti'])->name('pengguna.pembayaran.berkas-bukti');
                Route::post('/butki-bayar', [PembayaranController::class, 'unggahBukti'])->name('pengguna.pembayaran.unggah-bukti');
                Route::post('/cek-promo', [PembayaranController::class, 'cekPromo'])->name('pengguna.pembayaran.cek-promo');
            });
        });
    });
});
