<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\Auth\StudentRegisterController;
use App\Http\Controllers\EkycController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::resource('mahasiswa', MahasiswaController::class);

        Route::resource('ruangan', RuanganController::class);
        Route::resource('dosen', DosenController::class);
    });

            Route::get('/register-mahasiswa', [StudentRegisterController::class, 'showRegistrationForm'])
                ->name('register.mahasiswa');

            Route::post('/register-mahasiswa', [StudentRegisterController::class, 'register'
        ]);
                          
                Route::middleware(['auth'])->prefix('ekyc')->group(function () {
                Route::get('step1', [EkycController::class, 'step1'])->name('ekyc.step1');
                Route::post('step1', [EkycController::class, 'storeStep1'])->name('ekyc.storeStep1');
                // sementara redirect kosong untuk step2
                Route::get('step2', function () {
                return "Step 2: Upload Dokumen (belum dibuat)";
                })->name('ekyc.step2');
            });

require __DIR__.'/auth.php';

// Student dashboard route (used after student registration)
// Route::get('/student/dashboard', function () {
//     return view('student.dashboard');
// })->middleware(['auth', 'verified'])->name('student.dashboard');
