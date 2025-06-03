<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StandardController;
use App\Models\standard;

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



Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/forgot-password', [PasswordResetController::class, 'showForgotForm'])->name('password.request');
Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])->name('password.update');


Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('index');
    });

    Route::resource('standard', StandardController::class);

    Route::post('/standards/{id}/parameters/download', [StandardController::class, 'downloadParametersPdf'])
    ->name('standard.parameters.download');

    Route::get('/standard/create', [StandardController::class, 'create'])->name('standard.create');
    Route::post('/standard', [StandardController::class, 'store'])->name('standard.store');

    Route::get('standard/{standard}/edit', [StandardController::class, 'edit'])->name('standard.edit');
    Route::put('standard/{standard}', [StandardController::class, 'update'])->name('standard.update');

    Route::delete('standards/{standard}', [StandardController::class, 'destroy'])->name('standard.destroy');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

