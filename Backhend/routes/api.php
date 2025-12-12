<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FilmController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminFilmController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Auth untuk LOgin, logout, dan ambil info user
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/user', [AuthController::class, 'me'])->middleware('auth:sanctum');

// Route admin untuk kelola data film
Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
    Route::get('/films', [AdminFilmController::class, 'index']);
    Route::post('/films', [AdminFilmController::class, 'store']);
    Route::get('/films/{id}', [AdminFilmController::class, 'show']);
    Route::put('/films/{id}', [AdminFilmController::class, 'update']);
    Route::delete('/films/{id}', [AdminFilmController::class, 'destroy']);
});
// Route publik untuk lihat daftar film, detail film, dan kategori
Route::get('/films', [FilmController::class,'index']);
Route::get('/films/search', [FilmController::class,'search']);
Route::get('/films/{slug}', [FilmController::class,'show']);

//Route untuk melihat film berdasarkan kategori
Route::get('/category', [CategoryController::class,'index']);
Route::get('/films/category/{slug}', [FilmController::class,'category']);

Route::get('/videos/{filename}', [FilmController::class, 'stream']);

