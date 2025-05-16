<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('sign-in');
})->name('sign-in');

Route::get('/sign-up', function () {
    return view('sign-up');
});

Route::get('/reset-password', function()
{
    return view('reset-password');
})->name('password.reset');

/// Google OAuth
Route::get('/auth/google', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/auth/google/callback', [UserController::class, 'googleOAuth']);

Route::get('/sign-out', [UserController::class, 'logout']);

Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'create']);

// Authenticated routes
Route::middleware(['auth'])->group(function()
{
    Route::get('/home', function () {
        return view('home');
    });

    Route::get('/chat', function () {
        return view('chat');
    });

    Route::get('/profile-edit', function () {
        return view('profile-edit');
    });
});

Route::fallback(function()
{
    return view('not-found');
});
