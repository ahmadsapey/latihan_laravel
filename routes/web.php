<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\Auth\StudentRegisterController;
use App\Http\Controllers\EkycController;
use App\Models\Mahasiswa;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Serve dashboard images placed in resources/views/gambar
Route::get('/dashboard/image/{file}', function ($file) {
    $path = resource_path('views/gambar/' . $file);
    if (!file_exists($path)) {
        abort(404);
    }
    return response()->file($path);
})->name('dashboard.image');

Route::get('/dashboard', function () {
    $mahasiswaCount = Mahasiswa::count();
    $kelasCount = Kelas::count();
    $userCount = User::count();

    // Collect images from resources/views/gambar if folder exists
    $images = [];
    $dir = resource_path('views/gambar');
    if (is_dir($dir)) {
        foreach (scandir($dir) as $file) {
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                $images[] = $file;
            }
        }
    }

    // Masukan berita hari ini
    $newsText = 'Selamat datang . Hari ini kuliah libur horeeeeeeeee.';

    return view('dashboard', compact('images', 'newsText'));
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
