<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ParameterPriceController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StandardController;
use App\Models\standard;
use PHPUnit\Runner\Extension\ParameterCollection;

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

Route::get('/standard/createOne', [StandardController::class, 'createOne'])->name('standard.createOne');
Route::post('/standard/storeOne', [StandardController::class, 'storeOne'])->name('standard.storeOne');


Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('index');
    });


    Route::resource('standard', StandardController::class);
    Route::apiResource('parameter-prices', ParameterPriceController::class);

    //

    Route::get('/parameter-prices', [ParameterPriceController::class, 'indexWeb'])->name('parameter-prices.index');
    Route::get('/create', [ParameterPriceController::class, 'create'])->name('parameter-prices.create');
    Route::get('parameter-prices/{id}/edit', [ParameterPriceController::class, 'edit'])->name('parameter-prices.edit');
    Route::put('parameter-prices/{id}', [ParameterPriceController::class, 'update'])->name('parameter-prices.update');
    Route::post('/parameter-prices', [ParameterPriceController::class, 'store'])->name('parameter-prices.store');
    Route::get('/parameter-prices/view/{id}', [ParameterPriceController::class, 'showWeb'])->name('parameter-prices.view');
    Route::delete('parameter-prices/{id}', [ParameterPriceController::class, 'destroy'])->name('parameter-prices.destroy');

    //

    Route::post('/standards/{code}/parameters/download', [StandardController::class, 'downloadParametersPdf'])->name('standard.parameters.download');

    Route::get('/standard/create', [StandardController::class, 'create'])->name('standard.create');
    Route::post('/standard', [StandardController::class, 'store'])->name('standard.store');

    Route::get('standard/{standard}/edit', [StandardController::class, 'edit'])
    ->name('standard.edit.multi');

    Route::put('standard/update', [StandardController::class, 'update'])
    ->name('standard.update.multi');

    Route::get('standard/{standard}/edit', [StandardController::class, 'edit'])->name('standard.edit');
    Route::put('standard/{standard}', [StandardController::class, 'update'])->name('standard.update');

    Route::delete('standard/{standard}/parameter/{parameter}', [StandardController::class, 'detachParameter'])
    ->name('standard.detachParameter');
    // Allow deleting each individual standard (per lab type)
    Route::delete('standard/{standard}', [StandardController::class, 'destroy'])
    ->name('standard.destroy');


    Route::delete('standards/{standard}', [StandardController::class, 'destroy'])->name('standard.destroy');
    Route::delete('/standard/delete-by-code/{code}', [StandardController::class, 'destroyByCode'])->name('standard.destroyByCode');


    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});