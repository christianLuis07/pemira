<?php

use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Verify;
use App\Http\Livewire\Auth\Register;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Livewire\Auth\Passwords\Email;
use App\Http\Livewire\Auth\Passwords\Reset;
use App\Http\Livewire\Auth\Passwords\Confirm;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Pemilih\CompleteData;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BelumVotingController as AdminBelumVotingController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\ProdiController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Admin\KandidatController;
use App\Http\Controllers\Pemilih\VotingController;
use App\Http\Controllers\Admin\TahunAjarController;
use App\Http\Controllers\Admin\OrganisasiController;
use App\Http\Controllers\Pemilih\DashboardController;
use App\Http\Controllers\Pemilih\HasilVotingController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Admin\HasilVotingController as AdminHasilVotingController;
use App\Http\Controllers\Admin\NarahubungController;

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

// Route::view('/', 'welcome')->name('home');
Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/organisasi', [PageController::class, 'organisasi'])->name('organisasi');
Route::get('/pemira', [PageController::class, 'pemira'])->name('pemira');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');


Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)
        ->name('login');

    // Route::get('register', Register::class)
    //     ->name('register');
});

// Route::get('password/reset', Email::class)
//     ->name('password.request');

// Route::get('password/reset/{token}', Reset::class)
//     ->name('password.reset');

// Route::middleware('auth')->group(function () {
//     Route::get('email/verify', Verify::class)
//         ->middleware('throttle:6,1')
//         ->name('verification.notice');

//     Route::get('password/confirm', Confirm::class)
//         ->name('password.confirm');
// });

Route::middleware(['auth', 'XssSanitizer'])->group(function () {
    // Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
    //     ->middleware('signed')
    //     ->name('verification.verify');

    Route::get('logout', LogoutController::class)
        ->name('logout');

    Route::get('pemilih/complete-data', [CompleteData::class, 'index'])->name('pemilih.complete-data');
});

// Route for admin
Route::group(['middleware' => ['role:admin', 'XssSanitizer']], function () {
    Route::prefix('admin/')->group(function () {

        // Route untuk menampilkan dashboard admin
        Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        // Route untuk proses logout admin
        Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');

        // Route untuk menampilkan halaman kelola user (daftar user)
        Route::get('/kelola-user', [UserController::class, 'index'])->name('admin.kelola-user');

        // Route untuk menampilkan halaman tambah user (form tambah user)
        Route::get('/kelola-user/create', [UserController::class, 'create'])->name('admin.kelola-user.create');

        // Route untuk menyimpan data user baru setelah proses penambahan user
        Route::post('/kelola-user/create', [UserController::class, 'store'])->name('admin.kelola-user.store');

        // Route untuk menampilkan halaman kelola program studi (daftar program studi)
        Route::get('/kelola-prodi', [ProdiController::class, 'index'])->name('admin.kelola-prodi');

        Route::get('/kelola-organisasi', [OrganisasiController::class, 'index'])->name('admin.kelola-organisasi');

        Route::get('/kelola-kandidat', [KandidatController::class, 'index'])->name('admin.kelola-kandidat');

        // Route untuk menyimpan data program studi baru setelah proses penambahan program studi
        Route::post('/kelola-prodi/create', [ProdiController::class, 'store'])->name('admin.kelola-prodi.store');

        Route::get('/kelola-tahun', [TahunAjarController::class, 'index'])->name('admin.kelola-tahun');
        Route::post('/kelola-tahun/create', [TahunAjarController::class, 'store'])->name('admin.kelola-tahun.store');

        Route::get('/kelola-kelas', [KelasController::class, 'index'])->name('admin.kelola-kelas');
        Route::post('/kelola-kelas/create', [KelasController::class, 'store'])->name('admin.kelola-kelas.store');

        Route::get('/hasil-voting', [AdminHasilVotingController::class, 'index'])->name('admin.hasil-voting');
        Route::get('/belum-voting', [AdminBelumVotingController::class, 'index'])->name('admin.belum-voting');


        Route::get('/belum-voting', [AdminBelumVotingController::class, 'index'])->name('admin.belum-voting');

        Route::get('/narahubung', [NarahubungController::class, 'index'])->name('admin.narahubung');
    });

});

// Route for user
Route::group(['middleware' => ['role:user', 'checkUserData', 'XssSanitizer']], function () {
    Route::prefix('pemilih/')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('pemilih.dashboard');
        Route::get('/voting', [VotingController::class, 'index'])->name('pemilih.voting');
        Route::get('/hasil-voting', [HasilVotingController::class, 'index'])->name('pemilih.hasil-voting');
    });
});

Route::get('/api/kelas', function () {
    $kelas = \App\Models\Kelas::all();
    return response()->json($kelas);
})->name('api.kelas')->middleware('auth');