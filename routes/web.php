<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;

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
Route::post('/add-to-cart/{id}', [ProductController::class, 'addToCart'])->name('add.to.cart');

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
//Trang quản lý sản phẩm
Route::prefix('admin')->group(function () {
    Route::get('/products', [AdminController::class, 'manageProducts'])->name('admin.products');
    
    // Route để Thêm
    Route::get('/products/create', [AdminController::class, 'create'])->name('admin.products.create');
    Route::post('/products/store', [AdminController::class, 'store'])->name('admin.products.store');

    // Route để Sửa
    Route::get('/products/{id}/edit', [AdminController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/{id}', [AdminController::class, 'update'])->name('admin.products.update');

    // Route để Xóa
    Route::delete('/products/{id}', [AdminController::class, 'destroy'])->name('admin.products.destroy');
});
//Trang tìm kiếm sản phẩm
Route::get('/search', [ProductController::class, 'search'])->name('products.search');

Route::get('/cart-details', [ProductController::class, 'getCartDetails'])->name('cart.details');
Route::post('/update-cart', [ProductController::class, 'updateCart'])->name('update.cart');

// --- KHU VỰC DÀNH CHO NGƯỜI DÙNG ĐÃ ĐĂNG NHẬP ---
Route::middleware('auth')->group(function () {
    Route::get('/change-password', [ProfileController::class, 'changePasswordForm'])->name('password.change');
    Route::post('/change-password', [ProfileController::class, 'updatePassword'])->name('password.update');
});



Route::middleware('auth')->group(function () {

    Route::get('/checkout', [OrderController::class, 'checkout']);

    Route::post('/place-order', [OrderController::class, 'placeOrder']);

    Route::post('/buy-now', [OrderController::class, 'buyNow']);

    Route::post('/checkout-selected', [OrderController::class, 'checkoutSelected']);

});