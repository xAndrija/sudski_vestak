<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::resource('ulogas', App\Http\Controllers\UlogaController::class);

Route::resource('klijents', App\Http\Controllers\KlijentController::class);

Route::resource('zahtevs', App\Http\Controllers\ZahtevController::class);

Route::resource('terenski-podacis', App\Http\Controllers\TerenskiPodaciController::class);

Route::resource('dokuments', App\Http\Controllers\DokumentController::class);

Route::resource('izvestajs', App\Http\Controllers\IzvestajController::class);

Route::resource('porukas', App\Http\Controllers\PorukaController::class);
