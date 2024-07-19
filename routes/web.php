<?php

use App\Http\Controllers\PhoneNumberController;
use Illuminate\Support\Facades\Route;


Route::get('/', [PhoneNumberController::class, 'index']);
Route::get('/phone-numbers', [PhoneNumberController::class, 'index'])->name('phone_numbers.index');
