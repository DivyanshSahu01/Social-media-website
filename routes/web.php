<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/sign-out', [UserController::class, 'logout']);

Route::post('/login', [UserController::class, 'login']);

// Authenticated routes
Route::middleware(['auth'])->group(function()
{
    Route::get('/home', function () {
        return view('home');
    });
});

Route::fallback(function()
{
    return view('not-found');
});
