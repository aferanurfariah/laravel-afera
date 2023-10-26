<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CastController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\PeranController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::controller(AuthController::class)->group(function() {
    // register form
    Route::get('/register', 'register')->name('auth.register');
    // store register
    Route::post('/store', 'store')->name('auth.store');
    // login from
    Route::get('/login', 'login')->name('auth.login');
    //auth proses
    Route::post('/auth', 'auth')->name('auth.authentication');
    // logout
    Route::post('logout', 'logout')->name('auth.logout');
    //dashboard
    Route::get('/dashboard', 'dashboard')->name('auth.dashboard');
});
// Route::get('/', function () {
//     return view('welcome1');
// });


Route::get('/', [UserController::class, 'index']);

Route::get('/', function () {
    return view('auth.login');
})->name('login');
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/form', [UserController::class, 'form']);


Route::resource('/genre', GenreController::class)->middleware('auth');

// For CRUD table cast
Route::resource('/cast', CastController::class)->middleware('auth');

Route::resource('/film', FilmController::class)->middleware('auth');

Route::get('/film/{film}/peran/create', [PeranController::class, 'create'])->name('peran.create')->middleware('auth');
Route::post('/film/{film}/peran', [PeranController::class, 'store'])->name('peran.store')->middleware('auth');
