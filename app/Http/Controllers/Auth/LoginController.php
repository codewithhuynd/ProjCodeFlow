<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Mở giao diện trang đăng nhập
    public function showLogin()
    {
        return view('auth.login');
    }

    // Xử lý khi bấm nút Đăng nhập
    public function login(Request $request)
    {
        // Nhận Email và Password người dùng nhập
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Kiểm tra xem có khớp với Database không
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Hợp lệ -> Chuyển về trang chủ (welcome)
            return redirect('/home');
        }

        // Sai -> Quay lại báo lỗi
        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không chính xác.',
        ])->onlyInput('email');
    }
    // Xử lý Đăng xuất
    public function logout(Request $request)
    {
        Auth::logout(); // Hủy phiên đăng nhập của người dùng

        $request->session()->invalidate(); // Xóa toàn bộ dữ liệu session
        $request->session()->regenerateToken(); // Tạo lại token bảo mật (chống hack CSRF)

        return redirect('/home'); // Đăng xuất xong thì quay về trang chủ
    }
}

