<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatkulController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\Auth\StudentRegisterController;
use App\Http\Controllers\EkycController;
use App\Http\Controllers\Admin\EkycAdminController;
use App\Http\Controllers\LandingController;




use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/', [LandingController::class, 'index'])->name('landing');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // mahasiswa
    Route::get('/mahasiswa', [MahasiswaController::class,'index'])->name('mahasiswa.index');
    Route::post('/mahasiswa', [MahasiswaController::class,'store'])->name('mahasiswa.store');
    Route::get('/mahasiswa/{id}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
    Route::put('/mahasiswa/{id}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
    Route::delete('/mahasiswa/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');

    Route::resource('ruangan', RuanganController::class)->middleware(['auth']);
    Route::resource('matkul', MatkulController::class)->middleware(['auth']);
    Route::resource('dosen', DosenController::class)->middleware(['auth']);

    Route::prefix('admin')->group(function () {
        Route::get('/ekyc', [EkycAdminController::class, 'index'])->name('admin.ekyc.index');
        Route::get('/ekyc/{id}', [EkycAdminController::class, 'show'])->name('admin.ekyc.show');
        Route::post('/ekyc/{id}/verify', [EkycAdminController::class, 'verify'])->name('admin.ekyc.verify');
    });

});

Route::get('/register-mahasiswa', [StudentRegisterController::class, 'showRegistrationForm'])
    ->name('register.mahasiswa');

Route::post('/register-mahasiswa', [StudentRegisterController::class, 'register']);

Route::middleware(['auth'])->prefix('ekyc')->group(function () {
    Route::get('step1', [EkycController::class, 'step1'])->name('ekyc.step1');
    Route::post('step1', [EkycController::class, 'storeStep1'])->name('ekyc.storeStep1');

    Route::get('step2', function () {
        return "Step 2: Upload Dokumen (belum dibuat)";
    })->name('ekyc.step2');
    Route::get('/ekyc/step2', [EkycController::class, 'step2'])->name('ekyc.step2');
    Route::post('/ekyc/step2', [EkycController::class, 'storeStep2'])->name('ekyc.step2.store');

    Route::get('/ekyc/step3', [EkycController::class, 'showStep3'])->name('ekyc.step3');
    Route::post('/ekyc/step3', [EkycController::class, 'storeStep3'])->name('ekyc.step3.store');

    // Step 4 – Alamat Domisili & Referensi Sumber
    Route::get('/ekyc/step4', [EkycController::class, 'showStep4'])->name('ekyc.step4');
    Route::post('/ekyc/step4', [EkycController::class, 'storeStep4'])->name('ekyc.step4.store');

    Route::get('/ekyc/step5', [EkycController::class, 'step5'])->name('ekyc.step5');
});


require __DIR__.'/auth.php';
