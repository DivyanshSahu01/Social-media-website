<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\MailController;

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

Route::prefix('mail')->group(function(){
    Route::post('/register', [MailController::class, 'register']);
    Route::post('/resetPassword', [MailController::class, 'resetPassword']);
});

Route::post('/user/resetPassword', [UserController::class, 'resetPassword']);

Route::middleware('auth:sanctum')->group(function(){
    Route::prefix('user')->group(function(){
        Route::post('/edit', [UserController::class, 'edit']);
        Route::post('/updatePassword', [UserController::class, 'updatePassword']);
        Route::get('/listFriends', [UserController::class, 'listFriends']);
    });

    Route::prefix('message')->group(function(){
        Route::get('/list/{user_id}', [MessageController::class, 'list']);
        Route::post('/send', [MessageController::class, 'send']);
    });

    Route::prefix('post')->group(function(){
        Route::post('/create', [PostController::class, 'create']);
        Route::get('/list', [PostController::class, 'list']);
        Route::delete('/delete/{post_id}', [PostController::class, 'delete']);
    });

    Route::prefix('comment')->group(function(){
        Route::post('/add', [CommentController::class, 'add']);
        Route::get('/list/{post_id}', [CommentController::class, 'list']);
        Route::post('/reply/{comment_id}', [CommentController::class, 'reply']);
    });

    Route::prefix('like')->group(function(){
        Route::post('/add', [LikeController::class, 'add']);
        Route::post('/remove', [LikeController::class, 'remove']);
        Route::get('/list/{post_id}', [LikeController::class, 'list']);
    });
});