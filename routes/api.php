<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\PostController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');


Route::get('posts', [PostController::class, 'index']);
Route::post('posts', [PostController::class, 'store'])->middleware(['api.auth:api', 'role:admin,author']);
Route::get('posts/{post}', [PostController::class, 'show']);
Route::put('posts/{post}', [PostController::class, 'update'])->middleware(['api.auth:api', 'role:admin,author']);
Route::delete('posts/{post}', [PostController::class, 'destroy'])->middleware(['api.auth:api', 'role:admin,author']);

Route::post('posts/{post}/comments', [CommentController::class, 'store'])->middleware(['api.auth:api']);
