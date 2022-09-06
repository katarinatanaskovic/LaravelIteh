<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\UserBooksController;
use Doctrine\DBAL\Schema\Index;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware'=>['auth:sanctum']], function(){
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);


    Route::resource('books', BooksController::class)->only(['update','store','destroy']);
    Route::get('/users/{id}/books', [UserBooksController::class, 'index']);
    Route::delete('/books/delete/{id}',[BooksController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
Route::resource('books', BooksController::class)->only(['index']);
