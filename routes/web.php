<?php

use App\Http\Controllers\IzvestajController;
use App\Http\Controllers\PredmetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ZahtevController;
use App\Models\Izvestaj;
use App\Models\Predmet;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $predmeti = Predmet::orderByDesc('created_at')->limit(3)->get();
    $izvestaji = Izvestaj::orderByDesc('created_at')->limit(3)->get();

    return view('dashboard', compact('predmeti', 'izvestaji'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/predmeti', [PredmetController::class, 'index'])->name('predmeti');
    Route::get('/predmet/create', [PredmetController::class, 'create'])->name('predmet.create');
    Route::post('/predmet', [PredmetController::class, 'store'])->name('predmet.store');
    Route::get('/predmet/{predmet}/edit', [PredmetController::class, 'edit'])->name('predmet.edit');
    Route::put('/predmet/{predmet}', [PredmetController::class, 'update'])->name('predmet.update');
    Route::delete('/predmet/{predmet}', [PredmetController::class, 'destroy'])->name('predmet.destroy');

    Route::get('/zahtevi', [ZahtevController::class, 'index'])->name('zahtevi');
    Route::get('/zahtev/create', [ZahtevController::class, 'create'])->name('zahtev.create');
    Route::post('/zahtev', [ZahtevController::class, 'store'])->name('zahtev.store');
    Route::get('/zahtev/{zahtev}/edit', [ZahtevController::class, 'edit'])->name('zahtev.edit');
    Route::put('/zahtev/{zahtev}', [ZahtevController::class, 'update'])->name('zahtev.update');
    Route::delete('/zahtev/{zahtev}', [ZahtevController::class, 'destroy'])->name('zahtev.destroy');

    Route::get('/izvestaji', [IzvestajController::class, 'index'])->name('izvestaji');
    Route::get('/izvestaj/create', [IzvestajController::class, 'create'])->name('izvestaj.create');
    Route::post('/izvestaj', [IzvestajController::class, 'store'])->name('izvestaj.store');
    Route::get('/izvestaj/{izvestaj}/edit', [IzvestajController::class, 'edit'])->name('izvestaj.edit');
    Route::put('/izvestaj/{izvestaj}', [IzvestajController::class, 'update'])->name('izvestaj.update');
    Route::delete('/izvestaj/{izvestaj}', [IzvestajController::class, 'destroy'])->name('izvestaj.destroy');

    Route::resource('terenski-podacis', App\Http\Controllers\TerenskiPodaciController::class)->names('terenskiPodacis');
});

Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified', 'can:admin'])->group(function () {
    Route::resource('ulogas', App\Http\Controllers\UlogaController::class);
    Route::resource('klijents', App\Http\Controllers\KlijentController::class);
    Route::resource('zahtevs', App\Http\Controllers\ZahtevController::class);
    Route::resource('dokuments', App\Http\Controllers\DokumentController::class);
    Route::resource('izvestajs', App\Http\Controllers\IzvestajController::class);
    Route::resource('porukas', App\Http\Controllers\PorukaController::class);
});
