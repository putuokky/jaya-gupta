<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\pesertaDidikController;
use App\Http\Controllers\berandaController;
use App\Http\Controllers\RombelController;

Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::get('/captchachallenge', function () {
    return response()->json([
        'message' => 'CAPTCHA challenge endpoint',
    ]);
})->name('captchachallenge');
Route::get('/beranda', function () {
    return view('beranda');
})->middleware(['auth'])->name('beranda');
Route::middleware(['auth:web', 'role:superadmin|kepalasekolah|operator|pimpinan'])->group(function () {
    Route::get('data-sekolah', [SekolahController::class, 'index'])->name('data-sekolah');
    Route::get('data-sekolah/show/{id_level_wilayah}/{kode_wil}', [SekolahController::class, 'sekolah_kec'])->name('data-sekolah.show');
    Route::get('data-sekolah/show-detail/{npsn}', [SekolahController::class, 'sekolah_detail'])->name('data-sekolah.show-detail');
    Route::get('data-peserta-didik', [pesertaDidikController::class, 'index_admin'])->name('data-peserta-didik');
    Route::get('data-peserta-didik/show/{kode_wil}', [pesertaDidikController::class, 'peserta_didik_kec'])->name('data-peserta-didik.show');
    Route::get('data-peserta-didik/perSekolah/{kode_sekolah}', [pesertaDidikController::class, 'peserta_didik_sekolah'])->name('data-peserta-didik.peserta_didik_sekolah');
    Route::get('rombel',[RombelController::class, 'index'])->name('rombel.index');
     Route::get('rombel/perKecamatan/{kode_wil}',[RombelController::class, 'rombel_kec'])->name('rombel.rombel_kec');
    Route::get('rombel/perSekolah/{kode_sekolah}',[RombelController::class, 'rombel_sekolah'])->name('rombel.rombel_sekolah');
    Route::get('beranda',[berandaController::class,'index'])->name('beranda');
   
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
