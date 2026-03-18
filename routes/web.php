<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;

//trang đăng ký
Route::get('/register',[RegisterController::class,'showRegister']);

Route::post('/register',[RegisterController::class,'register']);

// Trang đăng nhập 
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Đăng xuất
  Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Trang Chủ
Route::get('/home', [HomeController::class, 'index'])->name('home');