<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\JobOfferController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/profile/edit', [ProfileController::class, 'edit']);
    Route::get('/profile/{id?}', [ProfileController::class, 'show']);
    Route::post('/profile/update', [ProfileController::class, 'update']);
    Route::post('/logout', [LoginController::class, 'logout']);

    Route::get('/posts', [PostController::class, 'index']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::get('/posts/{post}', [PostController::class, 'show']);
    Route::put('/posts/{post}', [PostController::class, 'update']);
    Route::delete('/posts/{post}', [PostController::class, 'destroy']);
    Route::get('/profile/{profileId}/posts', [PostController::class, 'viewProfilePosts']);
    Route::get('/home', [PostController::class, 'homeIndex']);

    Route::get('/job-offers', [JobOfferController::class, 'index']);
    Route::post('/job-offers', [JobOfferController::class, 'store']);
    Route::get('/job-offers/{jobOffer}', [JobOfferController::class, 'show']);
    Route::put('/job-offers/{jobOffer}', [JobOfferController::class, 'update']);
    Route::delete('/job-offers/{jobOffer}', [JobOfferController::class, 'destroy']);
});
