<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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



// [GET] /articles - listowanie wszystkich artykułów
Route::get('/articles', [ArticleController::class, 'index']);

// [GET] /article/:guid - szczegóły jednego artykułu
Route::get('/article/{article:id}', [ArticleController::class, 'show']);
