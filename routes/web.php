<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\ReviewController;

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

    // Quản trị đơn hàng
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders');
    Route::post('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
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



//QUÊN PASS
// 1. Link hiển thị form nhập Email (AC 1 & 2)
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

// 2. Xử lý khi khách bấm nút "Gửi Link" (AC 3)
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// 3. Link từ trong Email khách bấm vào để tạo pass mới (AC 4)
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

// 4. Xử lý lưu mật khẩu mới vào Database (AC 5)
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// --- KHU VỰC TỔNG HỢP CHO NGƯỜI DÙNG ĐÃ ĐĂNG NHẬP ---
Route::middleware('auth')->group(function () {
    // Chức năng Hồ sơ
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/change-password', [ProfileController::class, 'changePasswordForm'])->name('password.change');
    Route::post('/change-password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

    // Chức năng Đặt hàng
    Route::get('/checkout', [OrderController::class, 'checkout']);
    Route::post('/place-order', [OrderController::class, 'placeOrder']);
    Route::post('/buy-now', [OrderController::class, 'buyNow']);
    Route::post('/checkout-selected', [OrderController::class, 'checkoutSelected']);

    // Trang đơn hàng của tôi (User)
    Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('orders.my');
    // Chức năng Đánh giá sản phẩm
    Route::get('/review/order/{id}', [ReviewController::class, 'create']);
    Route::post('/review/store', [ReviewController::class, 'store'])->name('review.store');

});



// USER
Route::get('/my-orders', [OrderController::class, 'myOrders'])
    ->middleware('auth')
    ->name('my.orders');

// ADMIN
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/orders', [AdminOrderController::class, 'index'])
        ->name('admin.orders');

    Route::put('/orders/{order}', [AdminOrderController::class, 'updateStatus'])
        ->name('admin.orders.update');
});

Route::post('/remove-from-cart', [ProductController::class, 'removeFromCart'])->name('remove.cart');