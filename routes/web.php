<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\PageController::class, 'home'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(\App\Http\Controllers\PetitionController::class)->group(function () {
    Route::get('mypetitions', 'listMine')->name('petitions.mine')->middleware('auth');
    Route::get('petitions/add', 'create')->name('petitions.create')->middleware('auth');
    Route::get('petitions/signedpetitions', 'signedPetitions')->name('petitions.signedPetitions');
    Route::get('petitions/index', 'index')->name('petitions.index');
    Route::get('petitions/{id}', 'show')->name('petitions.show');
    Route::get('petitions/category/{category}', 'listCategory')->name('petitions.category');

    Route::post('petition', 'store')->name('petitions.store')->middleware('auth');
    Route::post('petitions/sign/{id}', 'sign')->name('petitions.sign')->middleware('auth');
    Route::delete('petitions/{id}', 'delete')->name('petitions.delete')->middleware('auth');
    Route::put('petitions/{id}', 'update')->name('petitions.update')->middleware('auth');

    Route::get('petitions/edit/{id}', 'update')->name('petitions.edit')->middleware('auth');
});

Route::get('/users/firmas', [\App\Http\Controllers\UserController::class, 'petitionsFirmadas'])
    ->middleware('auth');

require __DIR__.'/auth.php';
