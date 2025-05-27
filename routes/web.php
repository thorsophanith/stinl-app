<?php

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

Route::get('/', function () {
    return view('index');
});

Route::resource('standard', StandardController::class);

Route::post('/standards/{id}/parameters/download', [StandardController::class, 'downloadParametersPdf'])
    ->name('standard.parameters.download');

