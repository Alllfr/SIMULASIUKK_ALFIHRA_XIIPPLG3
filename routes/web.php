<?php

use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\DataKamarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;


use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\DataKamar;

Route::get('/', function (Request $request) {

    $query = DataKamar::query();

    if ($request->tipe_kamar) {
        $query->where('tipe_kamar', $request->tipe_kamar);
    }

    $kamar = $query->get();

    return view('welcome', compact('kamar'));

})->name('welcome');


Route::middleware(['auth','admin'])->group(function () {

    Route::get('/admin/dashboard',
        [DataKamarController::class,'index']
    )->name('admin.dashboard');
    Route::get('/admin/search', [DataKamarController::class, 'search'])->name('admin.search');
    Route::get('/admin/create',
        [DataKamarController::class,'create']
    )->name('admin.create');

    Route::post('/admin/store',
        [DataKamarController::class,'store']
    )->name('admin.store');

    Route::get('/admin/edit/{id}',
        [DataKamarController::class,'edit']
    )->name('admin.edit');

    Route::put('/admin/update/{id}',
        [DataKamarController::class,'update']
    )->name('admin.update');

    Route::delete('/admin/delete/{id}',
        [DataKamarController::class,'destroy']
    )->name('admin.delete');
    Route::get('/admin/reservasi',
        [ReservasiController::class,'index']
    )->name('admin.reservasi');

    Route::put('/admin/reservasi/{id}',
        [ReservasiController::class,'updateStatus']
    )->name('admin.reservasi.update');

});

Route::get('/reservasi/create',
    [ReservasiController::class, 'create']
)->name('reservasi.create');

Route::post('/reservasi/store',
    [ReservasiController::class, 'store']
)->name('reservasi.store');


Route::middleware(['auth'])->group(function () {
    Route::resource('kamar', DataKamarController::class);
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


require __DIR__.'/auth.php';
