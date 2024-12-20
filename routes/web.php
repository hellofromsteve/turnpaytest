<?php

use App\Http\Controllers\OTPController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('tests', [OTPController::class, 'addNumber'])->name('tests');
Route::post('tests', [OTPController::class, 'sendCode']);