<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;

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



Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

//Trang admin
//Khi người dùng vào /admin/login (GET) → gọi hàm showLogin() trong AdminController để hiển thị form login admin:
Route::get('/admin/login',[AdminController::class,'showLogin']);
//Khi người dùng gửi form đăng nhập admin (POST) → gọi hàm login() để kiểm tra email + password:
Route::post('/admin/login',[AdminController::class,'login']);
Route::prefix('admin') -> middleware(['auth','admin']) ->group(function(){
    //Khi người dùng vào /admin/dashboard → gọi hàm dashboard() để hiển thị trang quản trị.
    Route::get('/dashboard',[AdminController::class,'dashboard']);
    //Khi vào /admin/logout → gọi hàm logout() để đăng xuất.
    Route::get('/logout',[AdminController::class,'logout']);
});