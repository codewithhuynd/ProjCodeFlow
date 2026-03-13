<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;

//trang đăng ký
Route::get('/register',[RegisterController::class,'showRegister']);

Route::post('/register',[RegisterController::class,'register']);





