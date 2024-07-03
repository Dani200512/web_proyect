<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('web')->group(function () {

    Route::middleware('guest')->group(function () {
        Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
        Route::post('/register', [RegisterController::class, 'register'])->name('register');
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
        Route::post('/login', [LoginController::class, 'login'])->name('login');
    });

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});


    Route::get('/home', function () {
        return view('home');
    })->middleware('auth')->name('home');


Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
