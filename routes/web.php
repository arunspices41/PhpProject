<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/registeruser',[UserController::class, 'registeruser'])->name('user.registeruser');
Route::post('/saveuserdetails',[UserController::class,'saveuserdetails'])->name('user.saveuserdetails');
