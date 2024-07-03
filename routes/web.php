<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
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


    Route::middleware(['auth'])->group(function () {
        Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    });

    

Route::middleware(['auth'])->group(function () {
    // Rutas que requieren autenticación
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
});

// Rutas públicas
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::get('/profile/{profile}/posts', [PostController::class, 'profilePosts'])->name('profile.posts');


    