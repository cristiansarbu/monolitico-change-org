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
    Route::get('petitions/edit/{id}', 'getUpdatePage')->name('petitions.edit')->middleware('auth');

    Route::post('petition', 'store')->name('petitions.store')->middleware('auth');
    Route::post('petitions/sign/{id}', 'sign')->name('petitions.sign')->middleware('auth');
    Route::delete('petitions/{id}', 'delete')->name('petitions.delete')->middleware('auth');
    Route::put('petitions/{id}', 'update')->name('petitions.update')->middleware('auth');
});

Route::middleware('admin')->controller(\App\Http\Controllers\AdminPetitionController::class)->group(function() {
    Route::get('admin', 'index')->name('admin.home');

    Route::get('admin/petitions/add', 'create')->name('adminpetitions.create');
    Route::get('admin/petitions/{id}', 'show')->name('adminpetitions.show');
    Route::get('admin/petitions/edit/{id}', 'edit')->name('adminpetitions.edit');

    Route::post('admin/petitions', 'store')->name('adminpetitions.store');
    Route::delete('admin/petitions/{id}', 'delete')->name('adminpetitions.delete');
    Route::put('admin/petitions/{id}', 'update')->name('adminpetitions.update');
    Route::put('admin/petitions/status/{id}', 'changeStatus')->name('adminpetitions.status');
});

Route::middleware('admin')->controller(\App\Http\Controllers\AdminCategoryController::class)->group(function() {
    Route::get('admin/categories/index', 'index')->name('admincategories.index');
    Route::get('admin/categories/add', 'create')->name('admincategories.create');
    Route::get('admin/categories/{id}', 'show')->name('admincategories.show');
    Route::get('admin/categories/edit/{id}', 'edit')->name('admincategories.edit');

    Route::post('admin/categories', 'store')->name('admincategories.store');
    Route::delete('admin/categories/{id}', 'delete')->name('admincategories.delete');
    Route::put('admin/categories/{id}', 'update')->name('admincategories.update');
    Route::put('admin/categories/status/{id}', 'changeStatus')->name('admincategories.estado');
});

Route::middleware('admin')->controller(\App\Http\Controllers\AdminUserController::class)->group(function() {
    Route::get('admin/users/index', 'index')->name('adminusers.index');
    Route::get('admin/users/{id}', 'show')->name('adminusers.show');
    Route::get('admin/users/edit/{id}', 'edit')->name('adminusers.edit');

    Route::post('admin/users', 'store')->name('adminusers.store');
    Route::delete('admin/users/{id}', 'delete')->name('adminusers.delete');
    Route::put('admin/users/{id}', 'update')->name('adminusers.update');
    Route::put('admin/users/status/{id}', 'changeStatus')->name('adminusers.estado');
});

require __DIR__.'/auth.php';
