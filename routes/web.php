<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\pesertaDidikController;
use App\Http\Controllers\berandaController;
use App\Http\Controllers\RombelController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\TendikController;
use App\Http\Controllers\nonactiveController;
use Illuminate\Container\Attributes\Auth;


Route::get('/captchachallenge', function () {
    return response()->json([
        'message' => 'CAPTCHA challenge endpoint',
    ]);
})->name('captchachallenge');

Route::get('/', function () {
    $user = Auth::user();

    if ($user->hasRole('superadmin')) {
        return redirect()->route('beranda');
    } elseif ($user->hasRole('kepalasekolah')) {
        return redirect()->route('sekolah.beranda');
    } else {
        return redirect()->route('home');
    }
})->middleware('auth')->name('redirect_login');

Route::get('data-sekolah/show-detail/{npsn}', [SekolahController::class, 'sekolah_detail'])->name('data-sekolah.show-detail');
Route::get('guru/perSekolah/{kode_sekolah}', [GuruController::class, 'perSekolah'])->name('guru.perSekolah');
Route::get('tendik/perSekolah/{kode_sekolah}', [TendikController::class, 'perSekolah'])->name('tendik.perSekolah');
Route::middleware(['auth:web', 'role:superadmin'])->group(function () {
    Route::get('/beranda', function () {
    return view('beranda');
})->middleware(['auth'])->name('beranda');
    Route::get('data-sekolah', [SekolahController::class, 'index'])->name('data-sekolah');
    Route::get('data-sekolah/show/{id_level_wilayah}/{kode_wil}', [SekolahController::class, 'sekolah_kec'])->name('data-sekolah.show');
    Route::get('data-peserta-didik', [pesertaDidikController::class, 'index_admin'])->name('data-peserta-didik');
    Route::get('data-peserta-didik/show/{kode_wil}', [pesertaDidikController::class, 'peserta_didik_kec'])->name('data-peserta-didik.show');
    Route::get('data-peserta-didik/perSekolah/{kode_sekolah}', [pesertaDidikController::class, 'peserta_didik_sekolah'])->name('data-peserta-didik.peserta_didik_sekolah');
    Route::get('rombel',[RombelController::class, 'index'])->name('rombel.index');
     Route::get('rombel/perKecamatan/{kode_wil}',[RombelController::class, 'rombel_kec'])->name('rombel.rombel_kec');
    Route::get('rombel/perSekolah/{kode_sekolah}',[RombelController::class, 'rombel_sekolah'])->name('rombel.rombel_sekolah');
    Route::get('beranda',[berandaController::class,'index'])->name('beranda');
    Route::get('guru',[GuruController::class,'index'])->name('guru.index');
    Route::get('guru/perWilayah/{kode_wil}', [GuruController::class, 'perWilayah'])->name('guru.perWilayah');
    Route::get('tendik',[TendikController::class,'index'])->name('tendik.index');
    Route::get('tendik/perWilayah/{kode_wil}', [TendikController::class, 'perWilayah'])->name('tendik.perWilayah');
    Route::get('nonaktif',[nonactiveController::class, 'index_nonaktif'])->name('nonaktif');
    Route::get('nonaktif/perWilayah/{kode_wil}', [nonactiveController::class, 'perWilayah'])->name('nonaktif.perWilayah');
    Route::get('nonaktif/perSekolah/{kode_sekolah}', [nonactiveController::class, 'perSekolah'])->name('nonaktif.perSekolah');
   
});
// dd(Auth::user()->role);
Route::middleware(['auth:web', 'role:kepalasekolah'])->prefix('sekolah')->group(function () {
    Route::get('/guru/detail/{id}', [GuruController::class, 'detail'])->name('guru.detail');
    Route::get('/tendik/detail/{id}', [TendikController::class, 'detail'])->name('tendik.detail');
    Route::get('/beranda', [berandaController::class, 'index_sekolah'])->middleware(['auth'])->name('sekolah.beranda');
});
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});
