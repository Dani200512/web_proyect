<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobOfferController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\MultimediaController;
use App\Http\Controllers\ReactionController;
use App\Http\Controllers\SkillController;
use Illuminate\Support\Facades\Route;

// Ruta de bienvenida
Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación
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

// Ruta de inicio (home)
Route::get('/home', [PostController::class, 'homeIndex'])->middleware('auth')->name('home');
Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');

// Rutas para perfiles
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Rutas para posts
Route::middleware(['auth'])->group(function () {
    Route::resource('posts', PostController::class);
    Route::get('/profile/{profile}/posts', [PostController::class, 'viewProfilePosts'])->name('profile.posts');
});

Route::get('job-offers/create', [JobOfferController::class, 'create'])->name('job-offers.create');

// Rutas para ofertas de trabajo
Route::middleware(['auth'])->group(function () {
    Route::resource('job-offers', JobOfferController::class);
});

// Rutas para multimedia
Route::middleware(['auth'])->group(function () {
    Route::resource('multimedia', MultimediaController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('posts', PostController::class);
    Route::resource('multimedia', MultimediaController::class);
});

// Rutas para habilidades
Route::middleware(['auth'])->group(function () {
    Route::resource('skills', SkillController::class);
});

Route::get('/job-offers/{jobOffer}/apply', [JobApplicationController::class, 'apply'])->name('job-offers.apply');
Route::post('/job-offers/{jobOffer}/apply', [JobApplicationController::class, 'store'])->name('job-offers.apply.store');
Route::patch('/job-applications/{application}', [JobApplicationController::class, 'update'])->name('job-applications.update');
Route::get('/my-applications', [JobApplicationController::class, 'myApplications'])->name('my-applications');


Route::middleware(['auth'])->group(function () {
    Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::post('/posts/{post}/reactions', [ReactionController::class, 'toggle'])->name('reactions.toggle');
});

Route::resource('comments', CommentController::class)->only(['store', 'edit', 'update', 'destroy']);
Route::post('comments', [CommentController::class, 'store'])->name('comments.stor');
