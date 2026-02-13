<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/datatable/usuarios', function () {return view('datatable');})->middleware(['auth', 'verified'])->name('datatable');
Route::get('/calendar', function () {return view('calendar');})->middleware(['auth', 'verified'])->name('calendar');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//Datatable
Route::middleware('auth')->group( function(){
    Route::get('/datatable/index', [UsersController::class, 'index'])->name('datatable.index');
    Route::get('/datatable/users/{user}', [UsersController::class, 'profile'])->name('datatable.profile');
    Route::get('/datatable/find/{id}', [UsersController::class, 'find'])->name('datatable.find');
    Route::post('/datatable/create/user', [UsersController::class, 'store'])->name('datatable.store');
    Route::patch('/datatable/update/user', [UsersController::class, 'update'])->name('datatable.update');
    Route::delete('/datatable/delete/{id}', [UsersController::class, 'store'])->name('datatable.delete');





});

require __DIR__.'/auth.php';
